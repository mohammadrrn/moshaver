<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\Profile;
use App\Models\EstateRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPlans;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myEstateRequest = EstateRequest::where('user_id', auth()->id())->count();

        // Calculation Subscription Expiry
        $expiry_date = null;
        $date = null;
        $userSubscriptionPlan = Subscription::where('user_id', auth()->id())->with('plan', 'item')->first();
        if ($userSubscriptionPlan) {
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $userSubscriptionPlan->expiry_date);
            $date = Jalalian::fromDateTime($userSubscriptionPlan->expiry_date)->format('%Y/%m/%d');
            $from = Carbon::now();
            $expiry_date = $to->diffInDays($from);
        }

        /*foreach () {
            echo $notification->type;
        }*/

        $data = [
            'subscribeExpiry' => $expiry_date,
            'subscribePlan' => $userSubscriptionPlan,
            'myEstateRequest' => $myEstateRequest,
            'date' => $date
        ];
        return view('panel.index', compact('data'));
    }

    public function profile()
    {
        return view('panel.profile');
    }

    public function updateProfile(Profile $profile)
    {
        $user = User::find(auth()->id());
        $user->update([
            'full_name' => $profile['full_name'],
            'national_code' => $profile['national_code'],
            'email' => $profile['email'],
            'address' => $profile['address']
        ]);

        $columns = [
            'full_name',
            'national_code',
        ]; // Fields to be completed

        foreach ($columns as $column) {
            if ($user->$column != null) {
                $user->profileStatus = 1;
                $user->save();
            }
        }
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function changePassword(ChangePassword $changePassword)
    {
        $user = User::find(auth()->id());
        if (Hash::check($changePassword['old_password'], $user->password)) {
            if ($changePassword['new_password'] == $changePassword['password_confirmation']) {
                $user->password = bcrypt($changePassword['new_password']);
                $user->save();
                return redirect(route('panel.profile'))->with(['success' => 'عملیات با موفقیت انجام شد']);
            } else {
                return redirect(route('panel.profile'))->withErrors('کلمه عبور و تکرار کلمه عبور یکسان نمی باشد');
            }
        }
        return redirect(route('panel.profile'))->withErrors('کلمه عبور فعلی نادرست می باشد');
    }

    public function redirectTo($notification_id)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            if ($notification->id == $notification_id) {
                $notification->markAsRead();
                return redirect($notification->data[1]);
            }
        }
        return 0;
    }

    public function search(Request $request, $type)
    {
        if ($type == 'confirmedEstateRequestList') {
            $wheres = [];
            $wheres[] = ($request['owner_name'] != '') ? ['owner_name', 'like', '%' . $request['owner_name'] . '%'] : [];
            $wheres[] = ($request['owner_mobile_number'] != '') ? ['owner_mobile_number', $request['owner_mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'estateRequestList' => EstateRequest::with('user')->with('direction')->with('estateType')->with('areas')->with('transfer')->where($wheres)->where('status', 1)->orWhere('status', 2)->orderBy('id', 'desc')->paginate($this->pagination)
            ];
            return view('panel.estateRequest.confirmedEstateRequestList', compact('data'));
        } elseif ($type == 'unconfirmedEstateRequestList') {
            $wheres = [];
            $wheres[] = ($request['owner_name'] != '') ? ['owner_name', 'like', '%' . $request['owner_name'] . '%'] : [];
            $wheres[] = ($request['owner_mobile_number'] != '') ? ['owner_mobile_number', $request['owner_mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'estateRequestList' => EstateRequest::with('floorCovering')->with('direction')->with('estateType')->with('areas')->with('transfer')->where('status', 0)->where($wheres)->orderBy('id', 'desc')->paginate($this->pagination)
            ];
            return view('panel.estateRequest.unconfirmedEstateRequestList', compact('data'));
        } elseif ($type == 'myEstateRequest') {
            $wheres = [];
            $wheres[] = ($request['owner_name'] != '') ? ['owner_name', 'like', '%' . $request['owner_name'] . '%'] : [];
            $wheres[] = ($request['owner_mobile_number'] != '') ? ['owner_mobile_number', $request['owner_mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'estateRequestList' => EstateRequest::with('direction')->with('estateType')->with('areas')->with('transfer')->where('user_id', auth()->id())->where($wheres)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
            ];
            return view('panel.estateRequest.myEstateRequest', compact('data'));
        } elseif ($type == 'unconfirmedRequestList') {
            $wheres = [];
            $wheres[] = ($request['full_name'] != '') ? ['full_name', 'like', '%' . $request['full_name'] . '%'] : [];
            $wheres[] = ($request['mobile_number'] != '') ? ['mobile_number', $request['mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'requestList' => \App\Models\Request::with('areas')->with('estateType')->where('status', 0)->where($wheres)->orderBy('id', 'desc')->paginate($this->pagination)
            ];
            return view('panel.request.unconfirmedRequestList', compact('data'));
        } elseif ($type == 'confirmedRequestList') {
            $wheres = [];
            $wheres[] = ($request['full_name'] != '') ? ['full_name', 'like', '%' . $request['full_name'] . '%'] : [];
            $wheres[] = ($request['mobile_number'] != '') ? ['mobile_number', $request['mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'requestList' => \App\Models\Request::where('status', 1)->where($wheres)->orderBy('id', 'desc')->paginate($this->pagination)
            ];
            return view('panel.request.confirmedRequestList', compact('data'));
        } elseif ($type == 'myRequest') {
            $wheres = [];
            $wheres[] = ($request['full_name'] != '') ? ['full_name', 'like', '%' . $request['full_name'] . '%'] : [];
            $wheres[] = ($request['mobile_number'] != '') ? ['mobile_number', $request['mobile_number']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $data = [
                'estateRequestList' => \App\Models\Request::with('estateType')->with('areas')->with('transfer')->where('user_id', auth()->id())->where($wheres)->orderBy('id', 'desc')->paginate($this->pagination)
            ];
            return view('panel.request.myRequest', compact('data'));
        } elseif ($type == 'usersList') {
            $wheres = [];
            $wheres[] = ($request['full_name'] != '') ? ['full_name', 'like', '%' . $request['full_name'] . '%'] : [];
            $wheres[] = ($request['mobile_number'] != '') ? ['mobile_number', $request['mobile_number']] : [];
            $wheres[] = ($request['national_code'] != '') ? ['national_code', $request['national_code']] : [];
            $wheres[] = ($request['status'] != '') ? ['status', $request['status']] : [];
            $wheres[] = ($request['code'] != '') ? ['id', $request['code']] : [];
            $wheres = array_filter($wheres);
            $usersList = [];
            if ($request['plan'] == 1) {
                $usersList = User::whereHas(
                    'plan', function ($query) {
                    $query->where('plan_id', 1);
                })->with('item')->with('role')->paginate($this->pagination);
            } elseif ($request['plan'] == 2) {
                $usersList = User::whereHas(
                    'plan', function ($query) {
                    $query->where('plan_id', 2);
                })->with('item')->with('role')->paginate($this->pagination);
            } elseif ($request['plan'] == 'no-plan') {
                $usersList = User::doesntHave('plan')->with('item')->with('role')->where($wheres)->paginate($this->pagination);
            } else {
                $usersList = User::with('plan')->with('item')->with('role')->where($wheres)->paginate($this->pagination);
            }
            $data = [
                'usersList' => $usersList,
                'plan' => SubscriptionPlans::get()
            ];
            return view('panel.users.usersList', compact('data'));
        }
        return 0;
    }
}

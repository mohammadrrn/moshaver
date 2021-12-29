<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\Profile;
use App\Models\EstateRequest;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $userSubscriptionPlan = Subscription::where('user_id', auth()->id())->with('plan', 'item')->first();
        if ($userSubscriptionPlan) {
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $userSubscriptionPlan->expiry_date);
            $from = Carbon::now();
            $expiry_date = $to->diffInDays($from);
        }

        /*foreach () {
            echo $notification->type;
        }*/

        $data = [
            'subscribeExpiry' => $expiry_date,
            'subscribePlan' => $userSubscriptionPlan,
            'myEstateRequest' => $myEstateRequest
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
}

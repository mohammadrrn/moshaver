<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\EstateRequestDensityOption;
use App\Models\Invoice;
use App\Models\Bookmarks;
use App\Models\ResetPassword;
use App\Models\Subscription;
use App\Models\SubscriptionPlans;
use App\Models\SubscriptionPlansItem;
use App\Models\Transfer;
use App\Models\TrustedOffice;
use App\Models\User;
use App\Models\Zoonkan;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Zarinpal\Zarinpal;

class SiteController extends Controller
{

    use Notifiable;

    private $searchPagination = 10;
    private $trustedOfficePagination = 10;

    public function detail(Request $request, $id)
    {
        $userZoonkan = Zoonkan::where('user_id', auth()->id())->get(); // TODO : if buy gold plan then fetch zoonkan for best performance
        $estateRequest = EstateRequest::with('bookmark')->with('estateType')->with('direction')->where('id', $id)->where('status', 1)->orWhere('status', 2)->first();
        $similar = EstateRequest::with('estateType')->with('direction')->where('area_id', $estateRequest->area_id)->where('status', 1)->orWhere('status', 2)->where('id', '!=', $estateRequest->id)->take(3)->get();
        $data = [
            'detail' => $estateRequest,
            'zoonkan' => $userZoonkan,
            'similar' => $similar,
        ];


        if ($request->cookie('custom-info') != null) {
            $custom_info = json_decode($request->cookie('custom-info'));
            $data['custom-info'] = $custom_info;
        }
        return view('site.detail', compact('data'));
    }

    public function trustedOfficesList()
    {
        $trustedOffices = TrustedOffice::paginate($this->trustedOfficePagination);

        $data = [
            'trustedOffices' => $trustedOffices
        ];
        return view('site.trustedOffices', compact('data'));
    }

    public function search($type = '')
    {
        $area = Area::get();
        $transfer = Transfer::get();
        $estateType = Estate::get();
        $direction = Direction::get();
        $density = EstateRequestDensityOption::get();
        $options = AssistantController::estateRequestOptions();
        $where = [];

        switch ($type) {
            case 'rentAndMortgage':
                $where = [
                    ['buy_price', '=', 0],
                    ['rent_price', '!=', 0],
                    ['mortgage_price', '!=', 0],
                ];
                break;
            case 'buy':
                $where = [
                    ['buy_price', '!=', 0],
                    ['rent_price', '=', 0],
                    ['mortgage_price', '=', 0],
                ];
                break;
        }

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estateType' => $estateType,
            'direction' => $direction,
            'options' => $options,
            'type' => '',
            'estateRequests' => '',
            'density' => $density
        ];


        if ($type == 'marked') {
            $data['estateRequests'] = Bookmarks::with('estate')->where('user_id', auth()->id())->paginate($this->searchPagination);
            $data['type'] = 'marked';
        } else {
            $data['estateRequests'] = EstateRequest::where($where)->where('status', 1)->orWhere('status', 2)->paginate($this->searchPagination);
        }

        return view('site.search', compact('data'));
    }

    public function searchResult(Request $request)
    {
        $filter = $request->validate([
            'area_id' => ['numeric'],
            'transfer_id' => ['numeric'],
            'estate_id' => ['numeric'],
            'direction_id' => ['numeric'],
            'year_of_construction' => ['numeric'],
            'floor' => ['numeric'],
            'id' => ['numeric', 'nullable'],
            'option' => ['array'],
            'buy_price_from' => ['nullable', 'numeric'],
            'buy_price_to' => ['nullable', 'numeric'],
            'rent_price_from' => ['nullable', 'numeric'],
            'rent_price_to' => ['nullable', 'numeric'],
            'mortgage_price_from' => ['nullable', 'numeric'],
            'mortgage_price_to' => ['nullable', 'numeric'],
            'participation_price_from' => ['nullable', 'numeric'],
            'participation_price_to' => ['nullable', 'numeric'],
            'density_id' => ['nullable', 'numeric'],
        ]);

        if ($filter['id'] == null || $filter['id'] == '') {
            unset($filter['id']);
        }
        if (isset($filter['option'])) {
            foreach ($filter['option'] as $option => $value) {
                $filter["$option"] = $value;
            }
            unset($filter['option']);
        }

        if (isset($filter['transfer_id'])) {
            array_push($filter, ['transfer_id', '=', (int)$filter['transfer_id']]);
            if (($filter['buy_price_from'] != '' && $filter['buy_price_from'] != null) && $filter['buy_price_to'] != '' && $filter['buy_price_to'] != null) {
                array_push($filter, ['buy_price', '>=', (int)$filter['buy_price_from']], ['buy_price', '<=', (int)$filter['buy_price_to']]);
                unset($filter['buy_price_from']);
                unset($filter['buy_price_to']);
            }
            if (($filter['rent_price_from'] != '' && $filter['rent_price_from'] != null) && $filter['rent_price_to'] != '' && $filter['rent_price_to'] != null) {
                array_push($filter, ['rent_price', '>=', (int)$filter['rent_price_from']], ['rent_price', '<=', (int)$filter['rent_price_to']]);
                unset($filter['rent_price_from']);
                unset($filter['rent_price_to']);
            }
            if (($filter['mortgage_price_from'] != '' && $filter['mortgage_price_from'] != null) && $filter['mortgage_price_to'] != '' && $filter['mortgage_price_to'] != null) {
                array_push($filter, ['mortgage_price', '>=', (int)$filter['mortgage_price_from']], ['mortgage_price', '<=', (int)$filter['mortgage_price_to']]);
                unset($filter['mortgage_price_from']);
                unset($filter['mortgage_price_to']);
            }
            if (($filter['participation_price_from'] != '' && $filter['participation_price_from'] != null) && $filter['participation_price_to'] != '' && $filter['participation_price_to'] != null) {
                array_push($filter, ['participation_price', '>=', (int)$filter['participation_price_from']], ['participation_price', '<=', (int)$filter['participation_price_to']]);
                unset($filter['participation_price_from']);
                unset($filter['participation_price_to']);
            }
            if (isset($filter['density_id']) && $filter['density_id'] != null) {
                array_push($filter, ['density_id', '=', (int)$filter['density_id']]);
                unset($filter['density_id']);
            }
            unset($filter['transfer_id']);
        }

        $options = AssistantController::estateRequestOptions();
        $area = Area::get();
        $transfer = Transfer::get();
        $estateType = Estate::get();
        $direction = Direction::get();
        $density = EstateRequestDensityOption::get();
        $filter = array_filter($filter);
        $result = EstateRequest::where($filter)->where('status', 1)->orWhere('status', 2)->paginate($this->searchPagination);

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estateType' => $estateType,
            'direction' => $direction,
            'estateRequests' => $result,
            'options' => $options,
            'type' => '',
            'density' => $density
        ];
        return view('site.search', compact('data'));
    }

    public function block()
    {
        echo "???????? ???????????? ?????? ?????????? ?????? ??????"; // TODO : return view
    }

    public function bookmarked(Request $request)
    {
        if (auth()->user()) {
            $mark = Bookmarks::where('user_id', auth()->id())->where('estate_request_id', $request->input('marked_id'))->first();
            if (!$mark) {
                Bookmarks::create([
                    'estate_request_id' => $request->input('marked_id'),
                    'user_id' => auth()->id()
                ]);
                return response()->json(['success' => '???????????? ???? ???????????? ?????????? ????', 'img' => '/icon/marked.png']);
            }
            $mark->delete();
            return response()->json(['success' => '???????????? ???? ???????????? ?????????? ????', 'img' => '/icon/mark-icon.png']);
        }
        return response()->json(['success' => '?????????? ?????????? ????????']);
    }

    public function pay(Zarinpal $zarinpal, $rialPrice, $planId, $itemId)
    {
        $planCheckExist = SubscriptionPlans::find($planId);
        $itemCheckExist = SubscriptionPlansItem::find($itemId);

        if ($rialPrice > 0 && $planCheckExist && $itemCheckExist && $itemCheckExist->plan_id == $planCheckExist->id) {

            $amount = $itemCheckExist->plan_price * 10; // convert To rial and send to zarinpal
            $description = '???????? ' . $planCheckExist->title . ' ' . $itemCheckExist->time . ' ???????? ' . '???? ???????? ' . number_format($itemCheckExist->plan_price) . ' ?????????????????? ';

            $invoice = Invoice::create([
                'user_id' => auth()->id(),
                'plan_id' => $planCheckExist->id,
                'item_id' => $itemCheckExist->id,
                'amount' => $amount,
                'description' => $description,
            ]);

            $payment = [
                'callback_url' => route('panel.verify', [$invoice->id]),
                'amount' => $amount,
                'description' => $description,
            ];
            try {
                $response = $zarinpal->request($payment);
                $code = $response['data']['code'];
                $message = $zarinpal->getCodeMessage($code);
                if ($code === 100) {
                    $authority = $response['data']['authority'];
                    return $zarinpal->redirect($authority);
                }
                return "Error, Code: ${code}, Message: ${message}";
            } catch (RequestException $exception) {
                // handle exception
            }
        }
        return 0;
    }

    public function verify(Request $request, Zarinpal $zarinpal, $invoiceId)
    {
        $invoice = Invoice::with('item')->find($invoiceId);
        $payment = [
            'authority' => $request->input('Authority'),
            'amount' => $invoice->amount
        ];
        if ($request->input('Status') !== 'OK')
            return redirect(route('panel.subscription.plans'))->withErrors('???????????? ???? ???????? ?????????? ????');
        try {
            $response = $zarinpal->verify($payment);
            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);
            if ($code === 100) {
                $invoice->update([
                    'code' => $response['data']['code'],
                    'ref_id' => $response['data']['ref_id'],
                    'card_pan' => $response['data']['card_pan'],
                    'status' => 1,
                ]);

                // attach role and calculate expiry date
                $now = Carbon::now();
                $dayToAdd = $invoice->item->time * 30;
                Subscription::create([
                    'user_id' => auth()->id(),
                    'plan_id' => $invoice->plan_id,
                    'item_id' => $invoice->item_id,
                    'expiry_date' => $now->addDay($dayToAdd)
                ]);

                // TODO : Attach Role For User
                return redirect(route('panel.index'))->with(['success' => '???????????? ???? ???????????? ?????????? ????']);
            }
            //return "Error, Code: ${code}, Message: ${message}";
            return redirect(route('panel.index'))->with(['success' => '???????????? ???? ???????????? ?????????? ????']);
        } catch (RequestException $exception) {
            // handle exception
        }
        return 0;
    }

    public function forgetPassword()
    {
        return view('auth.forgetPassword');
    }

    public function sendResetPasswordCode(Request $request)
    {
        $valid = $request->validate([
            'mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
        ]);
        $checkExistUser = User::where('mobile_number', $valid['mobile_number'])->first();
        if (!$checkExistUser)
            return redirect(route('forgetPassword'))->withErrors(ResponseController::userDoesNotExist());
        $checkExistCode = ResetPassword::where('mobile_number', $valid['mobile_number'])->get();
        if (count($checkExistCode) > 2) {
            return redirect(route('forgetPassword'))->withErrors(ResponseController::tooManyRequestsForPasswordReset());
        }
        $code = AssistantController::randomCode();

        ResetPassword::create([
            'mobile_number' => $valid['mobile_number'],
            'code' => $code
        ]);

        ResetPasswordController::sendResetPasswordCode($code, $valid['mobile_number']);

        $data = [
            'mobile_number' => $valid['mobile_number']
        ];
        return view('auth.sendResetPasswordCode', compact('data'));
    }

    public function resetPasswordForm(Request $request)
    {
        $check = ResetPassword::where('mobile_number', $request->input('mobile_number'))->where('code', $request->input('code'))->first();
        if ($check) {
            $data = [
                'mobile_number' => $request->input('mobile_number'),
                'security_code' => bcrypt($request->input('mobile_number') . '-resetPassword')
            ];
            return view('auth.resetPasswordForm', compact('data'));
        } else {
            return '???? ???????? ?????? ???????? ?????? ???????? ???????? ?????????? ???????????? ????????';
        }
    }

    public function resetPassword(Request $request)
    {
        if (password_verify($request->input('mobile_number') . '-resetPassword', $request->input('security_code'))) {
            if ($request->input('password') == $request->input('repeat_password')) { // TODO :: Validation Password

                $reset = ResetPassword::where('mobile_number', $request->input('mobile_number'));
                $reset->delete();
                $user = User::where('mobile_number', $request->input('mobile_number'))->first();
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return redirect(route('login'))->withErrors(['???????? ???????? ???? ???????????? ?????????? ????????']);
            }
        } else {
            echo 'Are You Developer or Programmer ?';
        }
    }

    public function specialLink($userId)
    {
        $user = User::findOrFail($userId);
        if ($user->isAbleTo('special-link')) {
            $info = json_encode(['mobile_number' => $user->mobile_number, 'full_name' => $user->full_name]);
            return redirect(\route('index'))->withCookie(cookie('custom-info', $info)); // create cookie special link and return custom info for show in detail page
        }
        return abort(403);
    }
}

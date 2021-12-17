<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\Invoice;
use App\Models\Bookmarks;
use App\Models\Subscription;
use App\Models\SubscriptionPlans;
use App\Models\SubscriptionPlansItem;
use App\Models\Transfer;
use App\Models\TrustedOffice;
use App\Models\Zoonkan;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Zarinpal\Zarinpal;

class SiteController extends Controller
{

    use Notifiable;

    private $searchPagination = 10;
    private $trustedOfficePagination = 10;

    public function detail($id)
    {
        $userZoonkan = Zoonkan::where('user_id', auth()->id())->get(); // TODO : if buy gold plan then fetch zoonkan for best performance
        $estateRequest = EstateRequest::with('bookmark')->with('estateType')->with('direction')->where('status', '!=', 0)->findOrFail($id);
        $similar = EstateRequest::with('estateType')->with('direction')->where('area_id', $estateRequest->area_id)->where('status', '!=', 0)->where('id', '!=', $estateRequest->id)->take(3)->get();
        $data = [
            'detail' => $estateRequest,
            'zoonkan' => $userZoonkan,
            'similar' => $similar
        ];
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
        $options = AssistantController::estateRequestOptions();

        $where = [];
        switch ($type) {
            case 'rentAndMortgage':
                $where = [
                    ['rent_price', '!=', 0],
                    ['mortgage_price', '!=', 0]
                ];
                break;
            case 'buy':
                $where = [
                    ['buy_price', '!=', 0],
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
            'estateRequests' => ''
        ];

        if ($type == 'marked') {
            $data['estateRequests'] = Bookmarks::with('estate')->where('user_id', auth()->id())->paginate($this->searchPagination);
            $data['type'] = 'marked';
        } else {
            $data['estateRequests'] = EstateRequest::where('status', '1')->where($where)->paginate($this->searchPagination);
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
            'option' => ['array']
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
        $options = AssistantController::estateRequestOptions();
        $area = Area::get();
        $transfer = Transfer::get();
        $estateType = Estate::get();
        $direction = Direction::get();

        $filter['status'] = 1; // verified estate request
        $result = EstateRequest::where($filter)->paginate($this->searchPagination);

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estateType' => $estateType,
            'direction' => $direction,
            'estateRequests' => $result,
            'options' => $options,
            'type' => ''
        ];
        return view('site.search', compact('data'));
    }

    public function block()
    {
        echo "You are a Blocked";
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
                return response()->json(['success' => 'عملیات با موفقیت انجام شد', 'img' => '/icon/marked.png']);
            }
            $mark->delete();
            return response()->json(['success' => 'عملیات با موفقیت انجام شد', 'img' => '/icon/mark-icon.png']);
        }
        return response()->json(['success' => 'ابتدا لاگین کنید']);
    }

    public function pay(Zarinpal $zarinpal, $rialPrice, $planId, $itemId)
    {
        $planCheckExist = SubscriptionPlans::find($planId);
        $itemCheckExist = SubscriptionPlansItem::find($itemId);

        if ($rialPrice > 0 && $planCheckExist && $itemCheckExist && $itemCheckExist->plan_id == $planCheckExist->id) {

            $amount = $itemCheckExist->plan_price * 10; // convert To rial and send to zarinpal
            $description = 'خرید ' . $planCheckExist->title . ' ' . $itemCheckExist->time . ' ماهه ' . 'به مبلغ ' . number_format($itemCheckExist->plan_price) . ' هزارتومان ';

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
            return redirect(route('panel.subscription.plans'))->withErrors('عملیات با شکست مواجه شد');
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
                return redirect(route('panel.index'))->with(['success' => 'عملیات با موفقیت انجام شد']);
            }
            //return "Error, Code: ${code}, Message: ${message}";
            return redirect(route('panel.index'))->with(['success' => 'عملیات با موفقیت انجام شد']);
        } catch (RequestException $exception) {
            // handle exception
        }
        return 0;
    }

}

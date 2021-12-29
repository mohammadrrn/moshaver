<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestForm;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\Request;
use App\Models\Transfer;

class RequestController extends Controller
{
    public function myRequest()
    {
        $data = [
            'estateRequestList' => Request::with('estateType')->with('areas')->with('transfer')->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.request.myRequest', compact('data'));
    }

    public function unconfirmedRequestList()
    {
        $data = [
            'requestList' => Request::with('areas')->with('estateType')->where('status', 0)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.request.unconfirmedRequestList', compact('data'));
    }

    public function confirmRequest(\Illuminate\Http\Request $request)
    {
        $requests = Request::findOrFail($request->input('request_id'));
        $requests->status = 1;
        $requests->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function confirmedRequestList()
    {
        $data = [
            'requestList' => Request::where('status', 1)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.request.confirmedRequestList', compact('data'));
    }

    public function unConfirmRequest(\Illuminate\Http\Request $request)
    {
        $requests = Request::findOrFail($request->input('request_id'));
        $requests->status = 0;
        $requests->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function updateRequestForm($id)
    {
        $area = Area::where('status', 1)->get();
        $transfer = Transfer::get();
        $estate = Estate::get();
        $direction = Direction::get();

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estate' => $estate,
            'direction' => $direction,
            'request' => Request::findOrFail($id)
        ];
        return view('panel.request.updateRequestForm', compact('data'));
    }

    public function updateRequest(\Illuminate\Http\Request $request, $id)
    {
        $requests = Request::findOrFail($id);
        $requests->update($request->all());
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function deleteRequestForm($id)
    {
        $data = [
            'request' => Request::findOrFail($id)
        ];
        return view('panel.request.deleteRequestForm', compact('data'));
    }

    public function deleteRequest($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
        return redirect(route('panel.index'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function requestForm()
    {
        $area = Area::where('status', 1)->get();
        $transfer = Transfer::get();
        $estate = Estate::get();
        $direction = Direction::get(); // direction of estate

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estate' => $estate,
            'direction' => $direction
        ];

        return view('site.requestForm', compact('data'));
    }

    public function request(RequestForm $requestForm)
    {
        $check = Request::where('mobile_number', $requestForm['mobile_number'])->orWhere('area_id', $requestForm['area'])->orWhere('transfer_id', $requestForm['type_of_transfer'])->orWhere('estate_id', $requestForm['type_of_estate'])->first();
        if ($check == NULL) {
            Request::create([
                'user_id' => (auth()->id() != null ? auth()->id() : null),
                'full_name' => $requestForm['full_name'],
                'mobile_number' => $requestForm['mobile_number'],
                'area_id' => $requestForm['area_id'],
                'transfer_id' => $requestForm['type_of_transfer'],
                'estate_id' => $requestForm['type_of_estate'],
                'range_of_address' => $requestForm['range_of_address'],
                'rang_of_area' => AssistantController::filterNumber($requestForm['rang_of_area']),
                'buy_price' => ($requestForm['buy_price'] == '') ? 0 : AssistantController::clearSeparator($requestForm['buy_price']),
                'mortgage_price' => ($requestForm['mortgage_price'] == '') ? 0 : AssistantController::clearSeparator($requestForm['mortgage_price']),
                'rent_price' => ($requestForm['rent_price'] == '') ? 0 : AssistantController::clearSeparator($requestForm['rent_price']),
                'description' => $requestForm['description'],
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        } else {
            return redirect()->back()->with(['success' => 'این درخواست تکراری می باشد']);
        }
    }
}

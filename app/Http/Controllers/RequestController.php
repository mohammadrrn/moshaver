<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestForm;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\Request;
use App\Models\Transfer;

class RequestController extends Controller
{
    public function requestForm()
    {
        $area = Area::get();
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
                'full_name' => $requestForm['full_name'],
                'mobile_number' => $requestForm['mobile_number'],
                'area_id' => $requestForm['area_id'],
                'transfer_id' => $requestForm['type_of_transfer'],
                'estate_id' => $requestForm['type_of_estate'],
                'range_of_address' => $requestForm['range_of_address'],
                'rang_of_area' => $requestForm['rang_of_area'],
                'buy_price' => $requestForm['buy_price'],
                'mortgage_price' => $requestForm['mortgage_price'],
                'rent_price' => $requestForm['rent_price'],
                'description' => $requestForm['description'],
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        } else {
            return redirect()->back()->with(['success' => 'این درخواست تکراری می باشد']);
        }
    }
}

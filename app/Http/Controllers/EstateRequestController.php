<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstateForm;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EstateRequestController extends Controller
{

    public function myEstateRequest()
    {
        $data = [
            'estateRequestList' => EstateRequest::with('direction')->with('estateType')->with('areas')->with('transfer')->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.estateRequest.myEstateRequest', compact('data'));
    }

    public function unconfirmedEstateRequestList()
    {
        $data = [
            'estateRequestList' => EstateRequest::with('direction')->with('estateType')->with('areas')->with('transfer')->where('status', 0)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.estateRequest.unconfirmedEstateRequestList', compact('data'));
    }

    public function confirmEstateRequest(Request $request)
    {
        $request = EstateRequest::findOrFail($request->input('estate_request_id'));
        $request->status = 1;
        $request->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function confirmedEstateRequestList()
    {
        $data = [
            'estateRequestList' => EstateRequest::with('direction')->with('estateType')->with('areas')->with('transfer')->where('status','!=', 0)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.estateRequest.confirmedEstateRequestList', compact('data'));
    }

    public function unconfirmEstateRequest(Request $request)
    {
        $request = EstateRequest::findOrFail($request->input('estate_request_id'));
        $request->status = 0;
        $request->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function updateEstateRequestForm($id)
    {
        $area = Area::get();
        $transfer = Transfer::get();
        $estate = Estate::get();
        $direction = Direction::get();

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estate' => $estate,
            'direction' => $direction,
            'estateRequest' => EstateRequest::findOrFail($id)
        ];
        return view('panel.estateRequest.updateEstateRequestForm', compact('data'));
    }

    public function updateEstateRequest(Request $request, $id)
    {
        $estateRequest = EstateRequest::findOrFail($id);
        if ($request->input('options')) {
            $checkedOptions = [];
            foreach ($request->input('options') as $option => $value) {
                $checkedOptions[] = $option;
            }
            $uncheckedOptions = array_diff(AssistantController::estateRequestOptions(), $checkedOptions);
            foreach ($uncheckedOptions as $uncheckedOption => $value) {
                $estateRequest->$uncheckedOption = 0;
            }
            foreach ($checkedOptions as $checkedOption) {
                $estateRequest->$checkedOption = 1;
            }
            $estateRequest->update($request->all());
            $estateRequest->save();
        } else {
            foreach (AssistantController::estateRequestOptions() as $option => $value) {
                $estateRequest->$option = 0;
            }
            $estateRequest->update($request->all());
            $estateRequest->save();
        }
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function deleteEstateRequestForm($id)
    {
        $data = [
            'estateRequest' => EstateRequest::findOrFail($id)
        ];
        return view('panel.estateRequest.deleteEstateRequestForm', compact('data'));
    }

    public function deleteEstateRequest($id)
    {
        $estateRequest = EstateRequest::findOrFail($id);
        $estateRequest->delete();
        return redirect(route('panel.index'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function estateForm()
    {
        $area = Area::get();
        $transfer = Transfer::get();
        $estate = Estate::get();
        $direction = Direction::get();

        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estate' => $estate,
            'direction' => $direction,
        ];
        return view('site.estateForm', compact('data'));
    }

    public function estate(EstateForm $estate)
    {
        $checkEstateRequest = EstateRequest::where('owner_mobile_number', $estate['owner_mobile_number'])->where('address', $estate['address'])->where('area', $estate['area'])->where('floor', $estate['floor'])->first();
        if (!$checkEstateRequest) {
            $imageName = 'estateRequestImg/' . time() . '-image.jpg';
            $thumbnailName = 'estateRequestImg/' . time() . '-thumbnail.jpg';
            Image::make($_FILES['image']['tmp_name'])->insert('watermark.png')->save($imageName);
            Image::make($_FILES['image']['tmp_name'])->resize(200, 150)->insert('watermark.png')->save($thumbnailName);
            EstateRequest::create([
                'user_id' => (auth()->id() != null ? auth()->id() : null),
                'owner_name' => $estate['owner_name'],
                'owner_mobile_number' => AssistantController::filterNumber($estate['owner_mobile_number']),
                'image' => $imageName,
                'thumbnail' => $thumbnailName,
                'area_id' => $estate['area_id'],
                'transfer_id' => $estate['transfer_id'],
                'estate_id' => $estate['estate_id'],
                'address' => $estate['address'],
                'area' => AssistantController::filterNumber($estate['area']),
                'street_name' => $estate['street_name'],
                'plaque' => AssistantController::filterNumber($estate['plaque']),
                'floor' => AssistantController::filterNumber($estate['floor']),
                'number_of_floor' => AssistantController::filterNumber($estate['number_of_floor']),
                'number_of_room' => AssistantController::filterNumber($estate['number_of_room']),
                'apartment_unit' => AssistantController::filterNumber($estate['apartment_unit']),
                'year_of_construction' => AssistantController::filterNumber($estate['year_of_construction']),
                'direction_id' => $estate['direction_id'],
                'mortgage_price' => AssistantController::filterNumber($estate['mortgage_price']),
                'rent_price' => AssistantController::filterNumber($estate['rent_price']),
                'buy_price' => AssistantController::filterNumber($estate['buy_price']),
                'description' => $estate['description'],
                'empty' => $estate['empty'],
                'presell' => $estate['presell'],
                'exchange' => $estate['exchange'],
                'parking' => $estate['parking'],
                'warehouse' => $estate['warehouse'],
                'elevator' => $estate['elevator'],
                'electric_door' => $estate['electric_door'],
                'iphone_video' => $estate['iphone_video'],
                'toilet' => $estate['toilet'],
                'balcony' => $estate['balcony'],
                'wall_cupboard' => $estate['wall_cupboard'],
                'surface_gas' => $estate['surface_gas'],
                'master_bath' => $estate['master_bath'],
                'jacuzzi' => $estate['jacuzzi'],
                'security_door' => $estate['security_door'],
                'cctv' => $estate['cctv'],
                'presence_owner' => $estate['presence_owner'],
                'convertable' => $estate['convertable'],
                'rebuilt' => $estate['rebuilt'],
                'no_owner' => $estate['no_owner'],
                'full_authority' => $estate['full_authority'],
                'separate_way' => $estate['separate_way'],
                'single_type' => $estate['single_type'],
                'flat' => $estate['flat'],
                'barbecue' => $estate['barbecue'],
                'unit_zero' => $estate['unit_zero'],
                'roof_garden' => $estate['roof_garden'],
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
        return redirect()->back()->with(['success' => 'این درخواست قبلا ثبت شده است']);
    }
}

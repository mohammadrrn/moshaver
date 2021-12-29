<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstateForm;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\EstateRequestBuildingFacadesOption;
use App\Models\EstateRequestCabinetsOption;
use App\Models\EstateRequestCoolingSystemOption;
use App\Models\EstateRequestDocumentTypeOption;
use App\Models\EstateRequestFloorCoveringOption;
use App\Models\EstateRequestHeatingSystemOption;
use App\Models\EstateRequestWallPlugsOption;
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
        $where = [];
        if (isset(auth()->user()->area_id)) {
            $where['area_id'] = auth()->user()->area_id;
        }
        $data = [
            'estateRequestList' => EstateRequest::with('floorCovering')->with('direction')->with('estateType')->with('areas')->with('transfer')->where('status', 0)->where($where)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.estateRequest.unconfirmedEstateRequestList', compact('data'));
    }

    public function confirmEstateRequest(Request $request)
    {

        $confirm = EstateRequest::findOrFail($request->input('estate_request_id'));
        $confirm->status = 1;
        $confirm->save();
        ActionController::actionRegister($confirm, 'confirmed');
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function confirmedEstateRequestList()
    {
        $where = [];
        if (isset(auth()->user()->area_id)) {
            $where['area_id'] = auth()->user()->area_id;
        }
        $data = [
            'estateRequestList' => EstateRequest::with('user')->with('direction')->with('estateType')->with('areas')->where($where)->with('transfer')->where('status', '!=', 0)->orderBy('id', 'desc')->paginate($this->pagination) // paginate(10)
        ];
        return view('panel.estateRequest.confirmedEstateRequestList', compact('data'));
    }

    public function unconfirmEstateRequest(Request $request)
    {
        $request = EstateRequest::findOrFail($request->input('estate_request_id'));
        $request->status = 0;
        $request->save();
        ActionController::actionRegister($request, 'unconfirmed');
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function updateEstateRequestForm($id)
    {
        $area = Area::where('status', '1')->get();
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
        ActionController::actionRegister($estateRequest, 'update');
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
        ActionController::actionRegister($estateRequest, 'delete');
        return redirect(route('panel.estateRequest.unconfirmedEstateRequestList'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function estateForm()
    {
        $area = Area::where('status', '1')->get();
        $transfer = Transfer::get();
        $estate = Estate::get();
        $direction = Direction::get();
        $floorCovering = EstateRequestFloorCoveringOption::get();
        $cabinets = EstateRequestCabinetsOption::get();
        $wallPlugs = EstateRequestWallPlugsOption::get();
        $buildingFacades = EstateRequestBuildingFacadesOption::get();
        $heatingSystem = EstateRequestHeatingSystemOption::get();
        $coolingSystem = EstateRequestCoolingSystemOption::get();
        $documentType = EstateRequestDocumentTypeOption::get();


        $data = [
            'area' => $area,
            'transfer' => $transfer,
            'estate' => $estate,
            'direction' => $direction,
            'floorCovering' => $floorCovering,
            'cabinets' => $cabinets,
            'wallPlugs' => $wallPlugs,
            'buildingFacades' => $buildingFacades,
            'heatingSystem' => $heatingSystem,
            'coolingSystem' => $coolingSystem,
            'documentType' => $documentType,
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

            $status = (isset(auth()->user()->roles[0]->name) && auth()->user()->roles[0]->name == 'writer') ? 1 : 0;
            $estateRequest = EstateRequest::create([
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
                /*'street_name' => $estate['street_name'],*/
                'plaque' => AssistantController::filterNumber($estate['plaque']),
                'floor' => AssistantController::filterNumber($estate['floor']),
                'number_of_floor' => AssistantController::filterNumber($estate['number_of_floor']),
                'number_of_room' => AssistantController::filterNumber($estate['number_of_room']),
                'apartment_unit' => AssistantController::filterNumber($estate['apartment_unit']),
                'year_of_construction' => AssistantController::filterNumber($estate['year_of_construction']),
                'direction_id' => $estate['direction_id'],
                'mortgage_price' => ($estate['mortgage_price'] == '') ? 0 : AssistantController::clearSeparator($estate['mortgage_price']),
                'rent_price' => ($estate['rent_price'] == '') ? 0 : AssistantController::clearSeparator($estate['rent_price']),
                'buy_price' => ($estate['buy_price'] == '') ? 0 : AssistantController::clearSeparator($estate['buy_price']),
                'participation_price' => ($estate['participation_price'] == '') ? 0 : AssistantController::clearSeparator($estate['participation_price']),
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
                'status' => $status,
                'floor_covering_id' => $estate['floor_covering_id'],
                'cabinets_id' => $estate['cabinets_id'],
                'wall_plugs_id' => $estate['wall_plugs_id'],
                'building_facades_id' => $estate['building_facades_id'],
                'heating_system_id' => $estate['heating_system_id'],
                'cooling_system_id' => $estate['cooling_system_id'],
                'document_type_id' => $estate['document_type_id'],
            ]);
            if ($status == 0) {
                NotificationController::newEstateRequestNotification($estateRequest->id);
            }
            ActionController::actionRegister($estateRequest, 'insert');
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
        return redirect()->back()->with(['success' => 'این درخواست قبلا ثبت شده است']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddArea;
use App\Http\Requests\EditArea;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function addAreaForm()
    {
        echo view('panel.area.addAreaForm');
    }

    public function addArea(AddArea $area)
    {
        Area::create([
            'text' => $area['area_text']
        ]);
        return redirect(route('panel.area.areaList'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function areaList()
    {
        $data = [
            'areas' => Area::get()
        ];
        return view('panel.area.areaList', compact('data'));
    }

    public function editAreaForm($id)
    {
        $data = [
            'area' => Area::find($id)
        ];
        return view('panel.area.editAreaForm', compact('data'));
    }

    public function editArea(EditArea $request, $id)
    {
        $area = Area::find($id);
        $area->text = $request['area_text'];
        $area->save();
        return redirect(route('panel.area.areaList'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

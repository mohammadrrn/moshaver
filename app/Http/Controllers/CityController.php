<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityValidation;
use App\Models\City;

class CityController extends Controller
{
    public function addCityForm()
    {
        echo view('panel.city.addCityForm');
    }

    public function addCity(CityValidation $city)
    {
        City::create([
            'text' => $city['city_text']
        ]);
        return redirect(route('panel.city.cityList'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function cityList()
    {
        $data = [
            'cities' => City::get()
        ];
        return view('panel.city.cityList', compact('data'));
    }

    public function editCityForm($id)
    {
        $data = [
            'city' => City::find($id)
        ];
        return view('panel.city.editCityForm', compact('data'));
    }

    public function editCity(CityValidation $request, $id)
    {
        $city = City::find($id);
        $city->text = $request['city_text'];
        $city->save();
        return redirect(route('panel.city.cityList'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

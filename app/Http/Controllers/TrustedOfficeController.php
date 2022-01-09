<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrustedOffices;
use App\Http\Requests\TrustedOfficesUpdate;
use App\Models\TrustedOffice;
use App\Models\User;
use Illuminate\Http\Request;

class TrustedOfficeController extends Controller
{
    public function addTrustedOfficesForm()
    {
        $data = [
            'trustedOffices' => TrustedOffice::get()
        ];
        return view('panel.trustedOffices.addTrustedOfficesForm', compact('data'));
    }

    public function addTrustedOffices(TrustedOffices $offices)
    {
        TrustedOffice::create([
            'real_estate_name' => $offices['real_estate_name'],
            'full_name' => $offices['full_name'],
            'national_code' => $offices['national_code'],
            'mobile_number' => $offices['mobile_number'],
            'score' => $offices['score'],
            'address' => $offices['address'],
        ]);

        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function updateTrustedOfficesForm($id)
    {
        $data = [
            'trustedOffice' => TrustedOffice::find($id)
        ];
        return view('panel.trustedOffices.updateTrustedOfficesForm', compact('data'));
    }

    public function deleteTrustedOfficesForm($id)
    {
        $data = [
            'trustedOffice' => TrustedOffice::find($id)
        ];
        return view('panel.trustedOffices.deleteTrustedOfficesForm', compact('data'));
    }

    public function deleteTrustedOffices($id)
    {
        $office = TrustedOffice::find($id);
        $office->delete();
        return redirect(route('panel.trustedOffices.addTrustedOfficesForm'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function updateTrustedOffices(TrustedOfficesUpdate $update, $id)
    {
        $trustedOffice = TrustedOffice::find($id);
        $trustedOffice->update([
            'real_estate_name' => $update['real_estate_name'],
            'full_name' => $update['full_name'],
            'national_code' => $update['national_code'],
            'mobile_number' => $update['mobile_number'],
            'score' => $update['score'],
            'address' => $update['address'],
        ]);
        return redirect(route('panel.trustedOffices.addTrustedOfficesForm'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

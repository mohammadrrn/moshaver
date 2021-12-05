<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWriter;
use App\Models\User;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function addWriterForm()
    {
        $writerList = User::whereRoleIs($this->writerRole)->get();
        $data = [
            'writerList' => $writerList
        ];
        return view('panel.writer.addWriterForm', compact('data'));
    }

    public function addWriter(AddWriter $addWriter)
    {
        $writer = User::create([
            'full_name' => $addWriter['full_name'],
            'national_code' => $addWriter['national_code'],
            'mobile_number' => $addWriter['mobile_number'],
            'status' => 1,
            'profileStatus' => 1,
            'email' => $addWriter['email'],
            'password' => bcrypt($addWriter['password']),
            'mac_address' => AssistantController::getMacAddress()
        ]);
        $writer->attachRole('writer');
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function inactive($id)
    {
        $inactive = User::find($id);
        $inactive->status = 2; // block user
        $inactive->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWriter;
use App\Models\Action;
use App\Models\Area;
use App\Models\AreaWriter;
use App\Models\EstateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function addWriterForm()
    {
        $writerList = User::whereRoleIs($this->writerRole)->with('estateRequest')->get();
        $areas = Area::get();
        $data = [
            'writerList' => $writerList,
            'areas' => $areas
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
            'password' => bcrypt($addWriter['password']),
            'area_id' => $addWriter['area_id'],
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

    public function active($id)
    {
        $inactive = User::find($id);
        $inactive->status = 1; // block user
        $inactive->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function writerActions($id)
    {
        $actions = Action::where('user_id', $id)->paginate($this->pagination);
        $data = [
            'actions' => $actions
        ];
        return view('panel.writer.writerActions', compact('data'));
    }

    public function searchAction(Request $request)
    {
        $actions = Action::where('request_id', $request->input('code'))->with('writer')->orderBy('id', 'desc')->paginate($this->pagination);
        $data = [
            'actions' => $actions
        ];
        return view('panel.writer.searchAction', compact('data'));
    }

    public function updateForm($id)
    {
        $data = [
            'writer' => User::find($id),
            'areas' => Area::get(),
            'writerId' => $id
        ];
        return view('panel.writer.updateForm', compact('data'));
    }

    public function update(Request $request)
    {
        $writer = User::find($request->input('writer_id'));
        $writer->update([
            'full_name' => $request->input('full_name'),
            'national_code' => $request->input('national_code'),
            'email' => $request->input('email'),
            'mobile_number' => $request->input('mobile_number'),
            'area_id' => $request->input('area_id'),
            'password' => ($request->input('password') != '') ? bcrypt($request->input('password')) : $writer->password,
        ]); // TODO : Validation Update
        return redirect(route('panel.writer.addWriterForm'))->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

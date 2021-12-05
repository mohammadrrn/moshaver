<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToZoonkanRequest;
use App\Http\Requests\ZoonkanRequest;
use App\Models\MyZoonkan;
use App\Models\Zoonkan;
use Illuminate\Http\Request;

class ZoonkanController extends Controller
{
    public function createZoonkanForm()
    {
        $myZoonkan = Zoonkan::with('files')->where('user_id', auth()->id())->get();
        $data = [
            'myZoonkan' => $myZoonkan
        ];
        return view('panel.zoonkan.createZoonkanForm', compact('data'));
    }

    public function createZoonkan(ZoonkanRequest $zoonkan)
    {
        $checkZoonkanExist = Zoonkan::where('user_id', auth()->id())->where('zoonkan_name', $zoonkan['zoonkan_name'])->first();
        if (!$checkZoonkanExist) {
            Zoonkan::create([
                'user_id' => auth()->id(),
                'zoonkan_name' => $zoonkan['zoonkan_name'],
                'zoonkan_color' => $zoonkan['zoonkan_color'],
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
        return redirect()->back()->withErrors('این زونکن قبلا ایجاد شده است');
    }

    public function addToZoonkan(AddToZoonkanRequest $zoonkanRequest)
    {
        $checkExist = MyZoonkan::where('zoonkan_id', $zoonkanRequest['zoonkan_id'])->where('estate_request_id', $zoonkanRequest['file_id'])->first();
        if (!$checkExist) {
            MyZoonkan::create([
                'zoonkan_id' => $zoonkanRequest['zoonkan_id'],
                'estate_request_id' => $zoonkanRequest['file_id'],
                'user_id' => auth()->id()
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
        return redirect()->back()->withErrors('این آگهی در این زونکن وجود دارد');
    }

    public function zoonkanFiles($zoonkanId)
    {
        $zoonkanFile = MyZoonkan::where('user_id', auth()->id())->where('zoonkan_id', $zoonkanId)->with('estate')->paginate($this->pagination);
        $data = [
            'zoonkanFiles' => $zoonkanFile
        ];
        return view('panel.zoonkan.zoonkanFiles', compact('data'));
    }
}

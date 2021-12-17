<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToZoonkanRequest;
use App\Http\Requests\ZoonkanRequest;
use App\Models\MyZoonkan;
use App\Models\Zoonkan;
use App\Notifications\ZoonkanNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class ZoonkanController extends Controller
{
    use Notifiable;

    public function send() // TODO :: test Notification
    {
        Notification::send(auth()->user(), new ZoonkanNotification('saeed'));
    }

    public function received() // TODO :: test Notification
    {
        foreach (auth()->user()->unreadNotifications as $key => $notification) {
            echo $notification->data[$key] . '<br>';
            $notification->markAsRead();
        }
    }

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
            $evacuationDay = Carbon::now();
            MyZoonkan::create([
                'zoonkan_id' => $zoonkanRequest['zoonkan_id'],
                'estate_request_id' => $zoonkanRequest['file_id'],
                'user_id' => auth()->id(),
                'evacuation_day' => $evacuationDay->addDay($zoonkanRequest['evacuation_day'])
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
        return redirect()->back()->withErrors('این آگهی در این زونکن وجود دارد');
    }

    public function zoonkanFiles($zoonkanId)
    {
        $zoonkanFile = MyZoonkan::where('user_id', auth()->id())->where('zoonkan_id', $zoonkanId)->with('estate')->paginate($this->pagination);
        $data = [
            'zoonkanFiles' => $zoonkanFile,
            'now' => Carbon::now()
        ];
        return view('panel.zoonkan.zoonkanFiles', compact('data'));
    }

    public function removeFormZoonkan(Request $request)
    {
        $file = MyZoonkan::where('user_id', auth()->id())->where('id', $request->input('file_id'))->first();
        $file->delete();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WriterQueue;
use App\Notifications\EstateRequestNotification;
use App\Notifications\RequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function notificationList()
    {
        return view('panel.notification.notificationList');
    }

    public static function newEstateRequestNotification($estate)
    {
        $writerQueue = WriterQueue::where('area_id', $estate->area_id)->first();
        $writers = User::where('area_id', $estate->area_id)->get();
        $lastWriter = [];
        foreach ($writers as $writer) {
            if ($writer->id != $writerQueue->last_writer_id) {
                $lastWriter[] = $writer;
            }
        }

        $writerQueue = WriterQueue::where('area_id', $estate->area_id)->first();
        $writers = User::where('area_id', $estate->area_id)->get();
        $lastWriter = [];
        foreach ($writers as $writer) {
            if ($writer->id > $writerQueue->last_writer_id) {
                $lastWriter[$writer->id] = $writer;
            }
        }
        if (count($lastWriter) == 0) {
            $lastWriter[$writers[0]->id] = $writers[0];
        }
        $lastWriter = current($lastWriter);

        $writerQueue->last_writer_id = $lastWriter->id;
        $writerQueue->save();

        Notification::send($lastWriter, new EstateRequestNotification("آگهی جدید با کد : $estate->id", route('panel.estateRequest.unconfirmedEstateRequestList')));
    }

    public static function newRequest($id)
    {
        $writers = User::whereRoleIs('user')->get();
        Notification::send($writers, new RequestNotification("یک درخواست جدید با کد درخواست : $id", route('panel.request.userRequests')));
    }
}

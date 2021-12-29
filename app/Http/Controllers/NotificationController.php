<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EstateRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function notificationList()
    {
        return view('panel.notification.notificationList');
    }

    public static function newEstateRequestNotification($id)
    {
        $writers = User::whereRoleIs('writer')->where('area_id', 1)->get();
        Notification::send($writers, new EstateRequestNotification("آگهی جدید با کد : $id", route('panel.estateRequest.unconfirmedEstateRequestList')));
    }
}

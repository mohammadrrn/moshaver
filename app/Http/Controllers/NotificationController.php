<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public static function newEstateRequestNotification($id)
    {
        $writers = User::whereRoleIs('writer')->where('area_id', 1)->get();
        Notification::send($writers, new EstateRequestNotification("آگهی جدید با کد : $id", route('panel.estateRequest.unconfirmedEstateRequestList')));
    }

    public static function newRequest($id)
    {
        $writers = User::whereRoleIs('user')->get();
        Notification::send($writers, new RequestNotification("یک درخواست جدید با کد درخواست : $id", route('panel.request.userRequests')));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\MailNotification;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        $notification = auth()->user()->unreadNotifications;
        //dd($notification);
        if ($notification) {
            $notification->markAsRead();
            return redirect()->back();
        }
    }
   
}

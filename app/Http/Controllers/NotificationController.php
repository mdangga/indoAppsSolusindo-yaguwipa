<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // user
    public function bacaSemuaNotif()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['status' => 'success']);
    }

    // admin
    public function bacaSatuNotif($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect($notification->data['url'] ?? '/');
    }
}

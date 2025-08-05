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
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $notificationsQuery = auth()->user()->notifications()->orderBy('created_at', 'desc');

        if ($filter === 'unread') {
            $notificationsQuery->whereNull('read_at');
        }

        $notifications = $notificationsQuery->paginate(10);

        return view('notification', compact('notifications'));
    }

    public function bacaSatuNotif($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect($notification->data['url'] ?? '/');
    }
}

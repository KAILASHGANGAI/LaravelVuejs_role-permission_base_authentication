<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationControllers extends Controller
{
    public function index()
    {
        $data = Auth::user()->unreadNotifications;
        $userId = Auth::id();
        return response()->json(['data' => $data, 'id' => $userId]);
    }

    public function markReas($id)
    {
        foreach (Auth::user()->notifications as $notification) {
            if ($notification->id == $id) {
                $notification->markAsRead();
                return response()->json(['status' => 'Notification Readed']);
            }
        }
    }
    public function markReasAll()
    {
        foreach (Auth::user()->notifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json(['status' => 'Notification Readed']);
    }
}

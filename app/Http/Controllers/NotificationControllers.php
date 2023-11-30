<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationControllers extends Controller
{
    public function index()
    {
        $data = Auth::user()->notifications;
        return response()->json($data);
    }
}

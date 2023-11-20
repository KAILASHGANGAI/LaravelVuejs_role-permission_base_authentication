<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ownerDetails;
use App\Models\staff;
use App\Models\students;
use Illuminate\Support\Facades\Auth;

class utilityController extends Controller
{
    public function summery()
    {

        $std = students::all()->count();
        $staff = staff::count();

        return response()->json(
            [
                'student' => $std,
                'staff' => $staff,
            ]
        );
    }

    public function owner()
    {
        $data = ownerDetails::where('status', 1)->first();

        return response()->json($data);
    }

    public function studentPayment()
    {
        $data = students::select('id', 'user_id', 'tuitionfee')->with(['payment'])->where('user_id', Auth::id())->first();
        return response()->json($data);
    }
}

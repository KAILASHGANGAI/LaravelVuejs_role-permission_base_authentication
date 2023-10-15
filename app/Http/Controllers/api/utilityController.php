<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ownerDetails;
use App\Models\staff;
use App\Models\students;
use Illuminate\Http\Request;
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
                'staff' => $staff
            ]
        );
    }

    public function owner()
    {
        $data = ownerDetails::where('status', 1)->first();
        return response()->json($data);
    }
}

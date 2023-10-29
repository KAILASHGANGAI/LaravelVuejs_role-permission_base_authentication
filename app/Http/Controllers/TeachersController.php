<?php

namespace App\Http\Controllers;

use App\Models\staff;
use App\Models\students;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{
    public function attendence()
    {
        $currentMonth = Carbon::now()->month;
        $user_type = Auth::user()->roles[0]->name;

        if ($user_type == 'teacher') {
            $data = staff::select(['id', 'name'])
                ->with('attendance:id,status,date,staff_id')
                ->withcount([
                    'attendance as present_count' => function ($query) use ($currentMonth) {
                        $query->where('status', 1)
                            ->whereMonth('date', $currentMonth);
                    },
                    'attendance as absent_count' => function ($query) use ($currentMonth) {
                        $query->where('status', 0)
                            ->whereMonth('date', $currentMonth);
                    },
                ])
                ->where('user_id', Auth::id())
                ->first();

            return response()->json($data);
        }
        if ($user_type == 'student') {
            $data = students::select(['id', 'name'])
                ->with('attendance:id,status,created_at,students_id')
                ->withcount([
                    'attendance as present_count' => function ($query) use ($currentMonth) {
                        $query->where('status', 1)
                            ->whereMonth('created_at', $currentMonth);
                    },
                    'attendance as absent_count' => function ($query) use ($currentMonth) {
                        $query->where('status', 0)
                            ->whereMonth('created_at', $currentMonth);
                    },
                ])
                ->where('user_id', Auth::id())
                ->first();

            return response()->json($data);
        }
    }
}

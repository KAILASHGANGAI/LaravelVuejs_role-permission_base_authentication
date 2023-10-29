<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{
    public function attendence()
    {
        $currentMonth = Carbon::now()->month;

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
}

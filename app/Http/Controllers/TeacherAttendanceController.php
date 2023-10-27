<?php

namespace App\Http\Controllers;

use App\Models\staff;
use App\Models\teacherAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function search(Request $request)
    {
        $staffDetails = Staff::select('id', 'name')->withCount([
            'attendance as present_count' => function ($query) use ($request) {
                $query->where('status', 1)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year);
            },
            'attendance as absent_count' => function ($query) use ($request) {
                $query->where('status', 0)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year);
            }
        ])->get();

        return response()->json($staffDetails);
    }
    public function index()
    {
        $currentMonth = Carbon::now()->month;

        $staffDetails = Staff::select('id', 'name')->withCount([
            'attendance as present_count' => function ($query) use ($currentMonth) {
                $query->where('status', 1)
                    ->whereMonth('date', $currentMonth);
            },
            'attendance as absent_count' => function ($query) use ($currentMonth) {
                $query->where('status', 0)
                    ->whereMonth('date', $currentMonth);
            }
        ])->get();

        return response()->json($staffDetails);
    }
    public function store(Request $request)
    {
        $request->validate(['date' => 'required| unique:teacher_attendances']);
        try {
            foreach ($request->attendances as $att) {
                $new =  new teacherAttendance();
                $new->user_id = Auth::id();
                $new->staff_id = $att;
                $new->status = 1;
                $new->date = $request->date;
                $new->save();
            }

            foreach ($request->absent as $att) {
                $new =  new teacherAttendance();
                $new->user_id = Auth::id();
                $new->staff_id = $att;
                $new->status = 0;
                $new->date = $request->date;
                $new->save();
            }

            return response()->json(['status' => ' Attendence is created']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'Not Found Try Again!!']);
        }
    }
}

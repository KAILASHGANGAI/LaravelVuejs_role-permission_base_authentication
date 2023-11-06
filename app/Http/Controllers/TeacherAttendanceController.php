<?php

namespace App\Http\Controllers;

use App\Models\staff;
use App\Models\teacherAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function bymonth(Request $request)
    {

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        if (isset($request->month) && isset($request->year)) {
            $month = $request->month;
            $year = $request->year;
        }

        $staffDetails = Staff::select('id', 'name')->with([
            'attendance' => function ($query) use ($month, $year) {

                $query->select('id', 'staff_id', 'status', 'date')->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->orderBy('date');
            },
        ])->get();
        return response()->json($staffDetails);
    }
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
            },
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
            },
        ])->get();

        return response()->json($staffDetails);
    }

    public function store(Request $request)
    {
        $request->validate(['date' => 'required| unique:teacher_attendances']);
        try {
            foreach ($request->attendances as $att) {
                $new = new teacherAttendance();
                $new->user_id = Auth::id();
                $new->staff_id = $att;
                $new->status = 1;
                $new->date = $request->date;
                $new->save();
            }

            foreach ($request->absent as $att) {
                $new = new teacherAttendance();
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

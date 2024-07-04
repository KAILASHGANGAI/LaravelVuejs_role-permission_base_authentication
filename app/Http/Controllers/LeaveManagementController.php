<?php

namespace App\Http\Controllers;

use App\Models\LeaveManagement;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  LeaveManagement::where('student_id', Auth::id())->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required'
        ]);

        try {
            $data['student_id'] = Auth::id();

            $data['leave_days'] = Carbon::parse($request->start_date)
                ->diffInDays(Carbon::parse($request->end_date)) + 1;

            $create =  LeaveManagement::create($data);
            if ($create) {
                return response()->json([
                    'message' => 'Leave request Created Successfully',

                ]);
            }

            return response()->json([
                'message' => 'Something went wrong',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = LeaveManagement::select(['id', 'leave_type', 'start_date', 'end_date', 'reason'])
            ->where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveManagement $leaveManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required'
        ]);

        try {

            $data['leave_days'] = Carbon::parse($request->start_date)
                ->diffInDays(Carbon::parse($request->end_date)) + 1;

            $create =  LeaveManagement::where('id', $id)->update($data);
            if ($create) {
                return response()->json([
                    'message' => 'Leave request updated Successfully',

                ]);
            }

            return response()->json([
                'message' => 'Something went wrong',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveManagement $leaveManagement)
    {
        //
    }
}
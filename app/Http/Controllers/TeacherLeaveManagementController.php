<?php

namespace App\Http\Controllers;

use App\Models\TeacherLeaveManagement;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherLeaveManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $user_type = Auth::user()->roles[0]->name;

        if ($user_type == 'teacher') {
        $data =  TeacherLeaveManagement::where('staff_id', Auth::id())->get();
      
        }else{
        $data =  TeacherLeaveManagement::orderBy('id', 'DESC')->get();

        }
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
            $data['staff_id'] = Auth::id();

            $data['leave_days'] = Carbon::parse($request->start_date)
                ->diffInDays(Carbon::parse($request->end_date)) + 1;

            $create =  TeacherLeaveManagement::create($data);
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
        $data = TeacherLeaveManagement::select(['id', 'leave_type', 'start_date', 'end_date', 'reason'])
            ->where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherLeaveManagement $teacherLeaveManagement)
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

            $create =  TeacherLeaveManagement::where('id', $id)->update($data);
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
                'data' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = TeacherLeaveManagement::where('id', $id)->delete();
        if($data){
            $res = [
                'message'=>'Deleted Successfully'
            ];
        }else{
            $res = [
                'message'=>'Deleted Successfully'
            ];
        }
        return response()->json($res);
    }
    public function approve($id)
    {
        $data = TeacherLeaveManagement::where('id', $id)->first();
        $data->update([
            'approved_by'=>Auth::id(),
            'approved_by_name'=>Auth::user()->name,
            'status'=>'Approved'
        ]);
        if($data){

            $res = [
                'message'=>'Updated Successfully'
            ];
        }else{
            $res = [
                'message'=>'Failed To Approve'
            ];
        }
        return response()->json($res);
    }
    public function reject(Request $request , $id)
    {
       
        $data = TeacherLeaveManagement::where('id', $id)->first();
        $data->update([
            'decline_by'=>Auth::id(),
            'decline_reason'=> $request->rejectReason ?? null, 
            'decline_by_name'=>Auth::user()->name,
            'status'=>'Rejected'
        ]);
        if($data){

            $res = [
                'message'=>'Rejected Successfully'
            ];
        }else{
            $res = [
                'message'=>'Failed To Rejected'
            ];
        }
        return response()->json($res);
    }
}
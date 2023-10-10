<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\attendance;
use App\Models\createattendance;
use App\Models\students;
use App\Models\takeatd;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
       
        if($request->createattendances_id){
            $atten = takeatd::find($request->createattendances_id);
            $atten->status = 1;
            $atten->save();
            if (!empty($request->attendances)) {
            foreach ($request->attendances as  $value) {
                $new = new attendance();
                $new->students_id = $value;
                $new->createattendances_id = $request->createattendances_id;
                $new->status = 1;
                $new->save();
            } 

        }
            if (!empty($request->absent)) {
                foreach ($request->absent as  $value) {
                    $new = new attendance();
                    $new->students_id = $value;
                    $new->createattendances_id = $request->createattendances_id;
                    $new->status = 0;
                    $new->save();
                } 
            }
        return response()->json(['status'=>'success']);

        }else{
            return response()->json(['status'=>'error']);

        }
               
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data = takeatd::with('faculty','semester','section', 'attendances','attendances.students')->where('id',$id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //this function is used to fetch the students name and contact for absent students
        $takeatd = takeatd::find($id);
        $data = students::select('id','name','phone_no')->where('faculty', $takeatd->faculties_id)
        ->where('section_id', $takeatd->section)
        ->where('semester_yrs',$takeatd->semesters_id)->get();
        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}

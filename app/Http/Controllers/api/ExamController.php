<?php

namespace App\Http\Controllers\api;

use App\Models\exam;
use App\Http\Controllers\Controller;
use App\Models\question;
use Illuminate\Http\Request;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = exam::with(['faculty','semester','section'])->get();
       
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new exam();
        $new->faculty_id= $request->faculty_id;
        $new->semester_id= $request->semester_id;
        $new->section_id= $request->section_id;
        $new->exam_type = $request->exam_type;
        $new->date = $request->date;
        $new->time = $request->time;
        if ($new->save()) {
            return response()->json([
                'status'=>"added successfully"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(exam $exam)
    {
        $ques =$exam->ques;
        return response()->json($exam);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(exam $exam)
    {
        return response()->json($exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exam $exam)
    {
    
        $exam->faculties_id= $request->faculty_id;
        $exam->semester_id= $request->semester_id;
        $exam->section_id= $request->section_id;
        $exam->exam_type = $request->exam_type;
        $exam->date = $request->date;
        $exam->time = $request->time;

        if ($exam->save()) {

            return response()->json([
                'status'=>"updated successfully"
            ]);
        }
    }
       

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam $exam)
    {
        if ($exam->delete()) {
           return response()->json(['status'=>'deleted successfully']);
        }
    }
    public function routing(Request $request){
        $data = exam::select('id','exam_type','date','time')->where('faculty_id',$request->faculty)->where('semester_id',$request->semester)->where('section_id',$request->section)->get();
        
        if(count($data) > 0){
            return response()->json(['status'=>1,'data'=>$data]);
        }else{
            return response()->json(['status'=>0,'data'=>$data]);

        }
    }
}

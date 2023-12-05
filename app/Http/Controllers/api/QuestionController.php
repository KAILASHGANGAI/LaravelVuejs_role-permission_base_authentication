<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = question::all();

        return response()->json($data);
    }
    public function getquestions(Request $request)
    {
        $data = question::where('exams_id', $request->exam_id)->where('subject_id', $request->subject_id)->get();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);
        $new = new question();
        $new->exams_id = $request->exams_id;
        $new->subject_id = $request->subject_id;
        $new->questions = $request->questions;
        $new->option1 = $request->option1;
        $new->option2 = $request->option2;
        $new->option3 = $request->option3;
        $new->option4 = $request->option4;
        $new->trueoption = $request->trueoption;
        if ($new->save()) {
            return response()->json(['status' => 'Successfully Added']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        $question->questions = $request->questions;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->trueoption = $request->trueoption;
        if ($question->save()) {
            return response()->json(['status' => 'Successfully Updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(question $question)
    {
        if ($question->delete()) {
            return response()->json([
                'status' => 'deleted successfully',
            ]);
        }
    }
}

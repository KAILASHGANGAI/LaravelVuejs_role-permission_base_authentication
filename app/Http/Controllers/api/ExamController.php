<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\exam;
use App\Models\students;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('student')) {
            $student = students::select('id', 'faculty_id', 'semesters_id', 'section_id')
                ->where('user_id', Auth::id())
                ->first();
            $data = exam::with(['faculty', 'semester', 'section'])
                ->where('faculty_id', $student->faculty_id)
                ->where('semester_id', $student->semesters_id)
                ->get();
        } else {
            $data = exam::with(['faculty', 'semester', 'section'])->get();
        }

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
        $new = new exam();
        $new->faculty_id = $request->faculty_id;
        $new->semester_id = $request->semester_id;
        $new->section_id = $request->section_id;
        $new->exam_type = $request->exam_type;
        $new->date = $request->date;
        $new->time = $request->time;
        if ($new->save()) {
            return response()->json([
                'status' => 'added successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam  = exam::with(['faculty', 'semester', 'section'])->where('id', $id)->first();
        $subjects = subjects::where('semester_id', $exam->semester_id)->where('faculty_id', $exam->faculty_id)->get();
        return response()->json(['exam' => $exam, 'subjects' => $subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(exam $exam)
    {
        return response()->json($exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, exam $exam)
    {

        $exam->faculties_id = $request->faculty_id;
        $exam->semester_id = $request->semester_id;
        $exam->section_id = $request->section_id;
        $exam->exam_type = $request->exam_type;
        $exam->date = $request->date;
        $exam->time = $request->time;

        if ($exam->save()) {

            return response()->json([
                'status' => 'updated successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(exam $exam)
    {
        if ($exam->delete()) {
            return response()->json(['status' => 'deleted successfully']);
        }
    }

    public function routing(Request $request)
    {
        $data = exam::select('id', 'exam_type', 'date', 'time')
            ->where('faculty_id', $request->faculty)
            ->where('semester_id', $request->semester)
            ->where('section_id', $request->section)->get();

        if (count($data) > 0) {
            return response()->json(['status' => 1, 'data' => $data]);
        } else {
            return response()->json(['status' => 0, 'data' => $data]);
        }
    }
}

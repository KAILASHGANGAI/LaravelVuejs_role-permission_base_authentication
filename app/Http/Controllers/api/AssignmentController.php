<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\assignment;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('teacher')) {
            $data = assignment::with('faculty:id,faculty_name', 'semester:id,semester_years', 'section:id,section_name', 'user:id,name')->where('teachers_id', Auth::id())->get();
        }
        if ($user->hasRole('admin') || $user->hasRole('Super-Admin')) {
            $data = assignment::with('faculty:id,faculty_name', 'semester:id,semester_years', 'section:id,section_name', 'user:id,name')->get();
        }
        if ($user->hasRole('student')) {
            $student = students::select('id', 'faculty_id', 'semesters_id', 'section_id')
                ->where('user_id', Auth::id())
                ->first();

            $data = assignment::with('faculty:id,faculty_name', 'semester:id,semester_years', 'section:id,section_name', 'user:id,name')
                ->where('faculty_id', $student->faculty_id)
                ->where('semesters_id', $student->semesters_id)
                ->where('sections_id', $student->section_id)
                ->get();
        }

        return response()->json($data);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $new = new assignment();
        $new->subject = $request->subjects;
        $new->faculty_id = $request->faculty;
        $new->semesters_id = $request->semester;
        $new->sections_id = $request->section;
        $new->teachers_id = Auth::id();
        $new->topic = $request->topic;
        $new->deadline = $request->deadline;

        if ($request->file('file')) {
           
            $file_name = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')->move(public_path('uploads/assignments'), $file_name);

            $new->file_path = '/uploads/assignments/' . $file_name;

        }
        $new->save();

       
        return response()->json(['status' => 'File usploaded successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $assignment = assignment::with(['faculty:id,faculty_name', 'semester:id,semester_years'])->find($id);
        return response()->json($assignment);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(assignment $assignment)
    {
        return response()->json($assignment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $assignment = assignment::find($request->id);
        $assignment->subject = $request->subjects;
        $assignment->faculty_id = $request->faculty;
        $assignment->semesters_id = $request->semester;
        $assignment->sections_id = $request->section;
        $assignment->topic = $request->topic;
        $assignment->deadline = $request->deadline;

        if ($request->file('file')) {
            if ($assignment->file_path) {
                $unlinkpath = public_path($assignment->file_path);
                if (File::exists($unlinkpath)) {
                    unlink($unlinkpath);
                }
            }

            $file_name = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')->move(public_path('uploads/assignments'), $file_name);

            $assignment->file_path = '/uploads/assignments/' . $file_name;

        }
        $assignment->save();

        return response()->json(['message' => 'assignments Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(assignment $assignment)
    {
        if ($assignment->file_path) {
            $unlinkpath = public_path($assignment->file_path);
            if (File::exists($unlinkpath)) {
                unlink($unlinkpath);
            }
        }
        if ($assignment->delete()) {
            return response()->json([
                'status' => 'deleted successfully',
            ]);
        }
    }
    public function download($id)
    {
        try {
            $data = assignment::findOrFail($id);
            $filePath = $data->file_path;
            $fullPath = public_path($filePath);

            if (File::exists($fullPath)) {
                return response()->download($fullPath,);
            } else {
                return 'File not found';
            }
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

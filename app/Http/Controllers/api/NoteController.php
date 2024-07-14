<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\note;
use App\Models\students;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NoteController extends Controller
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
            $data = note::with('faculty:id,faculty_name', 'semester:id,semester_years',  'user:id,name')->where('teachers_id', Auth::id())->get();
        }
        if ($user->hasRole('admin') || $user->hasRole('Super-Admin')) {
            $data = note::with('faculty:id,faculty_name', 'semester:id,semester_years',  'user:id,name')->get();
        }
        if ($user->hasRole('student')) {
            $student = students::select('id', 'faculty_id', 'semesters_id')
                ->where('user_id', Auth::id())
                ->first();

            $data = note::with('faculty:id,faculty_name', 'semester:id,semester_years',  'user:id,name')
                ->where('faculty_id', $student->faculty_id)
                ->where('semesters_id', $student->semesters_id)
                ->get();
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf',
            ]);
            $new = new note();
            $new->subject = $request->subjects;
            $new->faculty_id = $request->faculty;
            $new->semesters_id = $request->semester;
            $new->teachers_id = Auth::id();
            $new->topic = $request->topic;

            if ($request->file('file')) {

                $file_name = time() . '_' . $request->file('file')->getClientOriginalName();

                $request->file('file')->move(public_path('uploads/notes'), $file_name);

                $new->file_path = '/uploads/notes/' . $file_name;
            }
            $new->save();

            return response()->json(['success' => 'Note Uploaded uploaded.']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = note::with(['faculty:id,faculty_name', 'semester:id,semester_years'])->find($id);
        return response()->json($note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(note $note)
    {
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = note::find($request->id);
        $note->subject = $request->subjects;
        $note->faculty_id = $request->faculty;
        $note->semesters_id = $request->semester;
        $note->teachers_id = Auth::id();
        $note->topic = $request->topic;
        if ($request->file('file')) {
            if ($note->file_path) {
                $unlinkpath = public_path($note->file_path);
                if (File::exists($unlinkpath)) {
                    unlink($unlinkpath);
                }
            }

            $file_name = time() . '_' . $request->file('file')->getClientOriginalName();

            $request->file('file')->move(public_path('uploads/notes'), $file_name);

            $note->file_path = '/uploads/notes/' . $file_name;

           
        }
        $note->save();

        return response()->json(['success' => 'Notes Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(note $note)
    {
        if ($note->file_path) {
            $unlinkpath = public_path($note->file_path);
            if (File::exists($unlinkpath)) {
                unlink($unlinkpath);
            }
        }
        if ($note->delete()) {
            return response()->json([
                'status' => 'deleted successfully',
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        try {
            $data = Note::findOrFail($id);
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

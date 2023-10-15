<?php

namespace App\Http\Controllers\api;

use App\Models\note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = note::with('faculty:id,faculty_name','semester:id,semester_years','user:id,name')->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf'
         ]);
        $new = new note();
        $new->subject = $request->subjects;
        $new->faculty_id =$request->faculty;
        $new->semesters_id = $request->semester;
        $new->teachers_id = Auth::id();
        $new->topic = $request->topic;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/notes', $file_name, 'public');

            $newname = time().'_'.$request->file->getClientOriginalName();
           $new->file_path = 'public/' . $file_path;
           $new->save();

            return response()->json(['success'=>'File uploaded successfully.']);
        }
        return response()->json(['success'=>'File Not uploaded.']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(note $note)
    {
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = note::find($request->id);
        $note->subject = $request->subjects;
        $note->faculty_id =$request->faculty;
        $note->semesters_id = $request->semester;
        $note->teachers_id = Auth::id();
        $note->topic = $request->topic;
        if($request->file()) {
            if (Storage::exists($note->file_path)) {
                Storage::delete($note->file_path);
            }
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/notes', $file_name, 'public');

            $newname = time().'_'.$request->file->getClientOriginalName();
           $note->file_path = 'public/' . $file_path;
        }
        $note->save();
        return response()->json(['success'=>'Notes Updated successfully.']);

           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(note $note) 
    {
        $filePath = $note->file_path;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        if($note->delete()){
            return response()->json([
                "status"=>"deleted successfully"
            ]);
        }
    }
}

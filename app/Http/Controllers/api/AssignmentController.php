<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\assignment;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use function PHPUnit\Framework\returnSelf;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = assignment::with('faculty:id,faculty_name','semester:id,semester_years','section:id,section_name','user:id,name')->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $data = assignment::findorfail($id);
        $filePath = $data->file_path;
        $fullPath = storage_path('app/' . $filePath);
    
        if (Storage::exists($filePath)) {
            return response()->download($fullPath);
        } else {
            return "failed";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $new = new assignment();
        $new->subject = $request->subjects;
        $new->faculty_id =$request->faculty;
        $new->semesters_id = $request->semester;
        $new->sections_id = $request->section;
        $new->teachers_id = Auth::id();
        $new->topic = $request->topic;
        $new->deadline = $request->deadline;
        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/assignments', $file_name, 'public');

            $newname = time().'_'.$request->file->getClientOriginalName();
           $new->file_path = 'public/' . $file_path;
           $new->save();

            return response()->json(['status'=>'File uploaded successfully.']);
        }
        return response()->json(['status'=>'File Not uploaded.']);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(assignment $assignment)
    {
        return response()->json($assignment);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(assignment $assignment)
    {
        return response()->json($assignment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $assignment = assignment::find($request->id);
        $assignment->subject = $request->subjects;
        $assignment->faculty_id =$request->faculty;
        $assignment->semesters_id = $request->semester;
        $assignment->sections_id = $request->section;
        $assignment->topic = $request->topic;
        $assignment->deadline = $request->deadline;
    
        if($request->file()) {
            if (Storage::exists($assignment->file_path)) {
                Storage::delete($assignment->file_path);
            }
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/assignments', $file_name, 'public');

            $newname = time().'_'.$request->file->getClientOriginalName();
           $assignment->file_path = 'public/' . $file_path;
        }
        $assignment->save();
        return response()->json(['ststus'=>'assignments Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(assignment $assignment)
    {
        $filePath = $assignment->file_path;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        if($assignment->delete()){
            return response()->json([
                "status"=>"deleted successfully"
            ]);
        }
    }
}

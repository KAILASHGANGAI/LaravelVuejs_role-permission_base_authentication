<?php

namespace App\Http\Controllers\api;

use App\Models\faculty;
use App\Http\Controllers\Controller;
use App\Models\libreary;
use App\Models\semester;
use Illuminate\Http\Request;

class LibrearyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = libreary::with(['faculty','semester'])->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $faculty = faculty::all();
        $sem = semester::all();
        return response()->json(
            [
                
                'faculty'=>$faculty,
                'sem'=>$sem
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new libreary() ;
        $new->book_name = $request->name;
        $new->publication = $request->publication;
        $new->faculty = $request->faculty;
        $new->semester = $request->semester;
        $new->total = $request->total;
        

        if ($new->save()) {
            return response()->json([
                "stats"=> 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\libreary  $libreary
     * @return \Illuminate\Http\Response
     */
    public function show(libreary $libreary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\libreary  $libreary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = libreary::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\libreary  $libreary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, libreary $libreary)
    {
        $update = $libreary ;

        $update->book_name = $request->name;
        $update->publication = $request->publication;
        $update->faculty = $request->faculty;
        $update->semester = $request->semester;
        $update->total = $request->total;
        

        if ($update->save()) {
            return response()->json([
                "stats"=> "success"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\libreary  $libreary
     * @return \Illuminate\Http\Response
     */
    public function destroy(libreary $libreary)
    {
        if($libreary->delete()){
            return response()->json([
                'status'=>"deleted successfully"
            ]);
        }
    }
}

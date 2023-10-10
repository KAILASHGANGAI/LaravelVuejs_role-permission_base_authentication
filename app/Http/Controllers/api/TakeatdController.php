<?php

namespace App\Http\Controllers\api;

use App\Models\students;
use App\Http\Controllers\Controller;
use App\Models\takeatd;
use Illuminate\Http\Request;
   
class TakeatdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = takeatd::with(['faculty','semester','section'])->get();
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
        $new = new takeatd();
        $new->staff_id=$request->staff_id;
        $new->faculty_id = $request->faculties_id;
        $new->semesters_id=$request->semesters_id;
        $new->section_id =$request->section;
        if ($new->save()) {
            return response()->json(date('d-m-Y'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\takeatd  $takeatd
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $takeatd = takeatd::with(['faculty','semester','section'])->where('id',$id)->first();
        $data = students::select('id','name')->where('faculty_id', $takeatd->faculty->id)
        ->where('section_id', $takeatd->section->id)
        ->where('semesters_id',$takeatd->semester->id)->get();
       
        return response()->json([
            "created"=>$takeatd,
            "students"=>$data
        ]);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\takeatd  $takeatd
     * @return \Illuminate\Http\Response
     */
    public function edit(takeatd $takeatd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\takeatd  $takeatd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, takeatd $takeatd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\takeatd  $takeatd
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = takeatd::find($id);
        $data->attendances()->delete();
        $data->delete();
        return response()->json(['status'=>'successfully deleted']);
    }
}

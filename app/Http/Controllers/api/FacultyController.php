<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = faculty::all();

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

        foreach ($request->faculties as $data) {
            if (isset($data)) {
                $new = new faculty();
                $new->faculty_name = $data;
                $new->save();
            }
        }

        return response()->json([
            'status' => 'Data saved successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = faculty::find($id);
        if ($data->delete()) {
            return response()->json([
                'status' => 'Data deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Data not deleted successfully',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\faculty;
use App\Models\period;
use App\Models\section;
use App\Models\semester;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = period::all();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = section::all();
        $faculty = faculty::all();
        $sem = semester::all();

        return response()->json(
            [
                'section' => $section,
                'faculty' => $faculty,
                'sem' => $sem,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new period();
        $new->faculty_id = $request->faculty;
        $new->semesters_id = $request->semester;
        $new->section_id = $request->section;
        $new->no_of_periods = $request->period_no;
        $new->teachers = $request->teacher;
        $new->subjects = $request->subject;
        $new->starttimes = $request->starttime;
        $new->endtimes = $request->endtime;
        if ($new->save()) {
            return response()->json('successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = period::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(period $period)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, period $period)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(period $period)
    {
        //
    }
}

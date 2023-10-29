<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\guardian;
use App\Models\students;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $stdId = students::max('id');
        $new = new guardian();
        $new->students_id = $stdId;
        $new->name = $request->name;
        $new->address = $request->address;
        $new->phone_no = $request->phone;
        $new->email = $request->email;
        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 240);
            $upload_path = 'images/guardians/';
            $image_url = $upload_path.$name;
            if ($img->save($image_url)) {
                $new->image = $image_url;

            }
        }
        if ($new->save()) {
            return response()->json([
                'status' => 'record successfully inserted',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = guardian::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, guardian $guardian)
    {

        $update = guardian::find($request->id);
        //  $update->studentId=$request->stdid;
        $update->name = $request->name;
        $update->address = $request->address;
        $update->phone_no = $request->phone;
        $update->email = $request->email;
        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 240);
            $upload_path = 'images/guardians/';
            $image_url = $upload_path.$name;
            if ($update->image != null) {
                unlink($update->image);
            }

            if ($img->save($image_url)) {
                $update->image = $image_url;

            }
        }
        if ($update->save()) {
            return response()->json([
                'status' => 'record successfully inserted',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(guardian $guardian)
    {
        //
    }
}

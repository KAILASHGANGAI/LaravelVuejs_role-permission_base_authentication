<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\blood_group;
use App\Models\faculty;
use App\Models\guardian;
use App\Models\section;
use App\Models\semester;
use App\Models\students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

//use Intervention\Image\ImageManager;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $data = students::with(['faculty', 'semester', 'section', 'blood:id,blood_group'])->get();

            return response()->json(
                ['students' => $data]
            );
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blood = blood_group::all();
        $faculty = faculty::all();
        $sem = semester::all();
        $section = section::all();

        return response()->json(
            [
                'blood' => $blood,
                'faculty' => $faculty,
                'sem' => $sem,
                'section' => $section,
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
        $request->validate([
            'studentname' => 'required',
            'email' => 'required|unique:students',
            'phone' => 'required',
            'address' => 'required',
            'faculty' => 'required',
            'section' => 'required',
            'sem' => 'required',
            'gender' => 'required',
            'tuitionfee' => 'required',
        ]);
        try {
            $user = User::create([
                'name' => $request->studentname,
                'email' => $request->email,
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('student');

            if (isset($user)) {
                $new = new students();
                $new->name = $request->studentname;
                $new->email = $request->email;
                $new->password = Hash::make('password');

                $new->phone_no = $request->phone;
                $new->address = $request->address;
                $new->DOB = $request->studentdob;
                $new->nationality = $request->nationality;
                $new->tuitionfee = $request->tuitionfee;
                $new->blood_group = $request->blood;
                $new->faculty_id = $request->faculty;
                $new->section_id = $request->section;
                $new->semesters_id = $request->sem;
                $new->gender = $request->gender;
                $new->user_id = $user->id;

                if ($request->photo) {
                    $position = strpos($request->photo, ';');
                    $sub = substr($request->photo, 0, $position);
                    $ext = explode('/', $sub)[1];
                    $name = time() . '.' . $ext;
                    $img = Image::make($request->photo)->resize(240, 240);
                    $upload_path = 'images/students/';
                    $image_url = $upload_path . $name;
                    if ($img->save($image_url)) {
                        $new->image = $image_url;
                    }
                }

                if ($new->save()) {

                    return response()->json([
                        'status' => 'record saved successfullly',
                    ]);
                }
            }

            return response()->json([
                'status' => 'record Already Exist',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Server Error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = students::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'studentname' => 'required',
            'studentemail' => 'required|email|',
            'studentphone' => 'required',
            'studentaddress' => 'required',
            'faculty' => 'required',
            'section' => 'required',
            'sem' => 'required',
            'gender' => 'required',
            'tuitionfee' => 'required',
        ]);
        $update = students::find($request->id);
        $update->name = $request->studentname;
        $update->email = $request->studentemail;
        $update->phone_no = $request->studentphone;
        $update->address = $request->studentaddress;
        $update->DOB = $request->studentdob;
        $update->nationality = $request->nationality;
        $update->tuitionfee = $request->tuitionfee;
        $update->blood_group = $request->blood;
        $update->faculty_id = $request->faculty;
        $update->section_id = $request->section;
        $update->semesters_id = $request->sem;
        $update->gender = $request->gender;
        $update->password = Hash::make(123123);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(240, 240);
            $upload_path = 'images/students/';
            $image_url = $upload_path . $name;
            // unlink($update->image);
            if ($img->save($image_url)) {
                $update->image = $image_url;
            }
        }

        if ($update->save()) {
            return response()->json([
                'status' => 'record saved successfullly',
                $update->guardian->id,
            ]);
        } else {
            return response()->json([
                'error' => 'failed',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = students::find($id);
        $guardian = guardian::where('students_id', $data->id)->first();

        if (!file_exists($data->image)) {
            $data->delete();
            $guardian->delete();

            return response()->json(['status' => 'record deleted successfully']);
        } else {
            if (file_exists($data->image)) {
                unlink($data->image);
                unlink($data->guardian->image);
            }

            $data->delete();
            $guardian->delete();

            return response()->json(['status' => 'record deleted successfully']);
        }
    }
}

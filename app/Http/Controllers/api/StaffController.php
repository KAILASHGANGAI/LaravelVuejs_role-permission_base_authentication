<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\blood_group;
use App\Models\staff;
use App\Models\staff_category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = staff::all();

        return response()->json(
            $data
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blood = blood_group::all();
        $category = staff_category::all();

        return response()->json(
            [
                'blood' => $blood,
                'category' => $category,
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'category' => 'required',
            'salary' => 'required',
            'experience' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('teacher');

        $edu_data = null;

        $new = new staff();
        $new->name = $request->name;
        $new->address = $request->address;
        $new->contact = $request->phone;
        $new->email = $request->email;
        $new->staff_category = $request->category;
        $new->gender = $request->gender;
        $new->salary = $request->salary;
        $new->bloodgroup = $request->blood;
        $new->dob = $request->dob;
        $new->experience = $request->experience;
        $new->user_id = $user->id;
        if ($request->images) {
            $position = strpos($request->images, ';');
            $sub = substr($request->images, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->images)->resize(240, 240);
            $upload_path = 'images/staffs/';
            $image_url = $upload_path.$name;
            // unlink($update->image);
            if ($img->save($image_url)) {
                $new->images = $image_url;
            }
        }
        if ($request->education) {
            foreach ($request->education as $edu) {
                $position = strpos($edu, ';');
                $sub = substr($edu, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = $request->name.uniqid().'.'.$ext;
                $img = Image::make($edu)->resize(240, 240);
                $upload_path = 'images/staffs/education/';
                $image_url = $upload_path.$name;
                // unlink($update->image);
                if ($img->save($image_url)) {
                    // $new->education = $image_url;
                    $edu_data .= $image_url.' ';
                }
            }
        }
        $new->education = $edu_data;

        if ($new->save()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = staff::find($id);

        return Response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = staff::find($id);
        $update->name = $request->name;
        $update->address = $request->address;
        $update->contact = $request->phone;
        $update->email = $request->email;
        $update->staff_category = $request->category;
        $update->gender = $request->gender;
        $update->salary = $request->salary;
        $update->bloodgroup = $request->blood;
        $update->dob = $request->dob;
        $update->experience = $request->experience;
        if ($request->images) {
            $position = strpos($request->images, ';');
            $sub = substr($request->images, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->images)->resize(240, 240);
            $upload_path = 'images/staffs/';
            $image_url = $upload_path.$name;
            // unlink($update->image);
            if ($img->save($image_url)) {
                $update->images = $image_url;
            }
        }
        if ($request->education) {
            $edu_data = '';
            foreach ($request->education as $edu) {
                $position = strpos($edu, ';');
                $sub = substr($edu, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = $request->name.uniqid().'.'.$ext;
                $img = Image::make($edu)->resize(240, 240);
                $upload_path = 'images/staffs/education/';
                $image_url = $upload_path.$name;
                // unlink($update->image);
                if ($img->save($image_url)) {
                    // $update->education = $image_url;
                    $edu_data .= $image_url.' ';
                }
            }
            $update->education = $edu_data;
        }

        if ($update->save()) {
            return response()->json([
                'status' => 'success',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

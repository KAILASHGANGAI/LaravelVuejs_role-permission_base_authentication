<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\testimonials;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class TestimonialsController extends Controller
{
    public function index()
    {
        $data = testimonials::all();

        return response()->json($data);
    }

    public function store(Request $req)
    {
        $new = new testimonials();
        $new->name = $req->name;
        $new->post = $req->post;
        $new->message = $req->message;
        if ($req->image) {
            $position = strpos($req->image, ';');
            $sub = substr($req->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($req->image)->resize(240, 240);
            $upload_path = 'images/testimonials/';
            $image_url = $upload_path.$name;

            if ($img->save($image_url)) {
                $new->image = $image_url;
            }
        }
        if ($new->save()) {
            return response()->json([
                'status' => 'Testimonials added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Testimonials Not added successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $data = testimonials::find($id);

        return response()->json($data);
    }

    public function update(Request $req, $id)
    {
        $update = testimonials::find($id);
        $update->name = $req->name;
        $update->post = $req->post;
        $update->message = $req->message;
        if ($req->image != $update->image) {
            $position = strpos($req->image, ';');
            $sub = substr($req->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($req->image)->resize(240, 240);
            $upload_path = 'images/testimonials/';
            $image_url = $upload_path.$name;
            if (isset($update->image)) {
                unlink($update->image);
            }
            if ($img->save($image_url)) {
                $update->image = $image_url;
            }
        }
        if ($update->save()) {
            return response()->json([
                'status' => 'Testimonials updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Testimonials Not updated successfully',
            ]);
        }
    }

    public function delete($id)
    {
        $data = testimonials::find($id);
        if (isset($data->image)) {
            unlink($data->image);

        }
        if ($data->delete()) {
            return response()->json([
                'status' => 'Testimonials deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Testimonials not deleted',
            ]);
        }
    }
}

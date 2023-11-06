<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    public function index()
    {
        $data = gallery::all();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (isset($request->eduImages)) {

            foreach ($request->eduImages as $img) {
                $new = new gallery();
                $position = strpos($img, ';');
                $sub = substr($img, 0, $position);
                $ext = explode('/', $sub)[1];
                $name = uniqid().'.'.$ext;
                $img = Image::make($img)->resize(240, 240);
                $upload_path = 'images/gallery/';
                $image_url = $upload_path.$name;
                if ($img->save($image_url)) {
                    $new->images = $image_url;
                    $new->save();
                }
            }

            return response()->json(['status' => 'images uploaded']);

        } else {
            return response()->json(['status' => 'images not uploaded']);

        }
    }

    public function delete($id)
    {
        $data = gallery::find($id);
        if ($data->delete()) {
            unlink($data->images);

            return response()->json(['status' => 'images Deleted']);

        } else {
            return response()->json(['status' => 'images not deleted']);

        }
    }
}

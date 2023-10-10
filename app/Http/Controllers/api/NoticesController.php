<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\notices;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class NoticesController extends Controller
{
    public function index(){
        $data = notices::all();
        return response()->json($data);
    }
    
    public function store(Request $req){
        $new = new notices();
        $new->heading = $req->heading;
        $new->description = $req->description;
        if($req->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/notices/';
            $image_url = $upload_path.$name;
          
            if($img->save($image_url)){
                $new->image = $image_url;
            }
          }
        if ($new->save()) {
            return response()->json([
                'status'=>'notices added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'notices Not added successfully'
            ]);
        }
    } 
    function edit($id){
        $data = notices::find($id);
        return response()->json($data);
    }
    function update(Request $req, $id){
        $update = notices::find($id);
        $update->heading = $req->heading;
      
        $update->description = $req->description;
        if($req->image != $update->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/notices/';
            $image_url = $upload_path.$name;
          if (isset($update->image)) {
                unlink($update->image);
          }
            if($img->save($image_url)){
                $update->image = $image_url;
            }
          }
        if ($update->save()) {
            return response()->json([
                'status'=>'notices updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'notices Not updated successfully'
            ]);
        }
    }
    function delete($id){
        $data = notices::find($id);
        if (isset($data->image)) {
            unlink($data->image);

        }
        if ($data->delete()) {
            return response()->json([
                'status'=>'notices deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'notices not deleted'
            ]);
        }
    }
}

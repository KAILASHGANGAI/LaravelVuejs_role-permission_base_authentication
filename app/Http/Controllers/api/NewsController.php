<?php

namespace App\Http\Controllers\api;

use App\Models\news;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    public function index(){
        $data = news::all();
        return response()->json($data);
    }
    
    public function store(Request $req){
        $new = new news();
        $new->heading = $req->heading;
        $new->description = $req->description;
        if($req->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/news/';
            $image_url = $upload_path.$name;
          
            if($img->save($image_url)){
                $new->image = $image_url;
            }
          }
        if ($new->save()) {
            return response()->json([
                'status'=>'news added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'news Not added successfully'
            ]);
        }
    } 
    function edit($id){
        $data = news::find($id);
        return response()->json($data);
    }
    function update(Request $req, $id){
        $update = news::find($id);
        $update->heading = $req->heading;
      
        $update->description = $req->description;
        if($req->image != $update->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/news/';
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
                'status'=>'news updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'news Not updated successfully'
            ]);
        }
    }
    function delete($id){
        $data = news::find($id);
        if (isset($data->image)) {
            unlink($data->image);

        }
        if ($data->delete()) {
            return response()->json([
                'status'=>'news deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'news not deleted'
            ]);
        }
    }
}

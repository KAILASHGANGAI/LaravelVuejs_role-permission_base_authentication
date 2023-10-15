<?php

namespace App\Http\Controllers\api;

use App\Models\events;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class EventsController extends Controller
{
    public function index(){
        $data = events::orderby('id','desc')->get();
        return response()->json($data);
    }
    
    public function store(Request $req){
        $new = new events();
        $new->heading = $req->heading;
        $new->event_date = $req->date;
        $new->description = $req->description;
        if($req->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/events/';
            $image_url = $upload_path.$name;
          
            if($img->save($image_url)){
                $new->image = $image_url;
            }
          }
        if ($new->save()) {
            return response()->json([
                'status'=>'events added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'events Not added successfully'
            ]);
        }
    } 
    function edit($id){
        $data = events::find($id);
        return response()->json($data);
    }
    function update(Request $req, $id){
        $update = events::find($id);
        $update->heading = $req->heading;
        $update->event_date = $req->date;
      
        $update->description = $req->description;
        if($req->image != $update->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/events/';
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
                'status'=>'events updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'events Not updated successfully'
            ]);
        }
    }
    function delete($id){
        $data = events::find($id);
        if (isset($data->image)) {
            unlink($data->image);

        }
        if ($data->delete()) {
            return response()->json([
                'status'=>'events deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'events not deleted'
            ]);
        }
    }
    function publish($id){
        $data = events::find($id);
        if ($data->status == 1 ) {
            $data->status = 0;
        }else{
            $data->status = 1;
        }

        if ($data->save()) {
            return response()->json([
                'status'=>'Status Changed'
            ]);
        }
    }
}

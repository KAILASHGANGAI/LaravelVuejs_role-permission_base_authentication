<?php

namespace App\Http\Controllers\api;

use App\Models\faculty_members;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class FacultyMembersController extends Controller
{
    public function index(){
        $data = faculty_members::all();
        return response()->json($data);
    }
    
    public function store(Request $req){
        $new = new faculty_members();
        $new->name = $req->name;
        $new->position = $req->position;
        $new->fb_link = $req->fb_link;
        $new->linked_link = $req->linked_link;
        $new->gmail_link = $req->gmail;
        if($req->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/faculty_members/';
            $image_url = $upload_path.$name;
          
            if($img->save($image_url)){
                $new->image = $image_url;
            }
          }
        if ($new->save()) {
            return response()->json([
                'status'=>'faculty_members added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'faculty_members Not added successfully'
            ]);
        }
    } 
    function edit($id){
        $data = faculty_members::find($id);
        return response()->json($data);
    }
    function update(Request $req, $id){
        $update = faculty_members::find($id);
        $update->name = $req->name;
        $update->position = $req->position;
        $update->fb_link = $req->fb_link;
        $update->linked_link = $req->linked_link;
        $update->gmail_link = $req->gmail;
        if($req->image != $update->image){
            $position = strpos($req->image,';');
            $sub = substr($req->image, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->image)->resize(240,240);
            $upload_path = 'images/faculty_members/';
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
                'status'=>'faculty_members updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'faculty_members Not updated successfully'
            ]);
        }
    }
    function delete($id){
        $data = faculty_members::find($id);
        if (isset($data->image)) {
            unlink($data->image);

        }
        if ($data->delete()) {
            return response()->json([
                'status'=>'faculty_members deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'faculty_members not deleted'
            ]);
        }
    }
}

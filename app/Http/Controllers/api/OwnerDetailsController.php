<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ownerDetails;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class OwnerDetailsController extends Controller
{
    public function index(){
        $data = ownerDetails::first();
        return response()->json($data);
    }
    public function store(Request $req){
        $req->validate([
            "school_name"=> "required",
            "email"=> "required|email|unique:owner_details",
            "pan_number"=> "required|unique:owner_details",
        ]);
        $new = new ownerDetails();
        $new->school_name  = $req->school_name;
        $new->phone = $req->phone;
        $new->email = $req->email;
        $new->address = $req->address;
        $new->pan_number = 	$req->pan_number;
        if($req->logo){
            $position = strpos($req->logo,';');
            $sub = substr($req->logo, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->logo)->resize(240,240);
            $upload_path = 'images/general/';
            $image_url = $upload_path.$name;
           // unlink($update->image);
            if($img->save($image_url)){
                $new->logo = $image_url;

            }
          }
        if ($new->save()) {
            return response()->json(
                ['status'=>'owner details saved']
            );
        }else{
            return response()->json(
                ['status'=>'owner details not  saved']
            );
        }
    }
    public function update(Request $req, $id){
      
        $update = ownerDetails::find($id);
        $update->school_name  = $req->school_name;
        $update->phone = $req->phone;
        $update->email = $req->email;
        $update->address = $req->address;
        $update->pan_number = 	$req->pan_number;
        if($req->logo != $update->logo){
            $position = strpos($req->logo,';');
            $sub = substr($req->logo, 0 , $position);
            $ext = explode('/',$sub)[1];
            $name = time().".".$ext;
            $img = Image::make($req->logo)->resize(240,240);
            $upload_path = 'images/general/';
            $image_url = $upload_path.$name;
            unlink($update->logo);
            if($img->save($image_url)){
                $update->logo = $image_url;

            }
          }
        if ($update->save()) {
            return response()->json(
                ['status'=>'owner details saved']
            );
        }else{
            return response()->json(
                ['status'=>'owner details not  saved']
            );
        }
    }


}

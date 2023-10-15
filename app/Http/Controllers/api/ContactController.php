<?php

namespace App\Http\Controllers\api;

use App\Models\contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $req){
        $new = new contact();
        $new->name =$req->name;
        $new->address=$req->address;
        $new->phone=$req->phone;
        $new->message=$req->message;
        if($new->save()){
            return back()->with('status','successfully');
        }
    }
}

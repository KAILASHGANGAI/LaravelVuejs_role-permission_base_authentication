<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\faculty;
use App\Models\onlineregistration;
use Illuminate\Http\Request;

class OnlineregistrationController extends Controller
{
    public function index()
    {
        $datas = faculty::select('id', 'faculty_name')->get();

        return view('/onlineregistration', compact('datas'));
    }

    public function store(Request $req)
    {
        $new = new onlineregistration();
        $new->name = $req->name;
        $new->address = $req->address;
        $new->phone = $req->phone;
        $new->gender = $req->gender;
        $new->course = $req->course;
        if ($new->save()) {
            return back()->with('status', 'successfully');
        }
    }
}

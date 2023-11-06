<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        return view('/enquiry');
    }

    public function store(Request $req)
    {
        $new = new enquiry();
        $new->name = $req->name;
        $new->gender = $req->gender;
        $new->phone = $req->phone;
        $new->details = $req->details;
        if ($new->save()) {
            return back()->with('status', 'successfully saved');
        }
    }
}

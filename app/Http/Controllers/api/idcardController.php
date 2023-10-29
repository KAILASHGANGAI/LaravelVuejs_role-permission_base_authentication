<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\students;
use Illuminate\Http\Request;

class idcardController extends Controller
{
    public function idcard(Request $req)
    {
        $data = students::select('name', 'address', 'phone_no', 'faculty_id', 'semesters_id', 'section_id', 'image')
            ->with(['faculty', 'semester', 'section'])
            ->where('faculty_id', $req->faculty)
            ->where('semesters_id', $req->semester)
            ->where('section_id', $req->section)->get();

        return response()->json($data);
    }
}

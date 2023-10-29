<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\bookstaken;
use App\Models\libreary;
use App\Models\students;
use Illuminate\Http\Request;

class BookstakenController extends Controller
{
    public function getBooks(Request $req)
    {
        $data = libreary::where('faculty', '=', $req->faculty)->where('semester', '=', $req->semester)->get();

        return response()->json($data);
    }

    public function getstudent(Request $req)
    {
        $data = students::where('name', '=', $req->student)->first();

        return response()->json($data);
    }

    public function saveBooks(Request $req)
    {
        $books = explode(',', $req->books);

        for ($i = 0; $i < count($books); $i++) {
            $check = bookstaken::where('librearies_id', $books[$i])->where('status', 0)->where('students_id', $req->student)->count();
            if ($check > 0) {
                $status = 0;

                continue;
            } else {
                $new = new bookstaken();
                $new->students_id = $req->student;
                $new->librearies_id = $books[$i];
                $new->book_code = '';
                if ($new->save()) {
                    $update = libreary::find($books[$i]);
                    $update->status = $update->status + 1;
                    $update->save();
                    $status = 1;
                }
            }
        }

        return response()->json(['status' => $status]);
    }

    public function ShowBooks(Request $req)
    {
        //where('name','=',$req->student)->first()
        $data = students::with('libreary.books')->where('name', '=', $req->student)->first();

        return response()->json([
            'student' => $data,
        ]);
    }

    public function returnBooks(Request $req)
    {
        $books = explode(',', $req->books);
        for ($i = 0; $i < count($books); $i++) {
            $update = bookstaken::find($books[$i]);
            if ($update->status == 0) {

                $update->status = 1;

                if ($update->save()) {
                    $boo = libreary::find($update->librearies_id);
                    $boo->status = $boo->status - 1;
                    $boo->save();
                }
            } else {
                return response()->json('Already Returned');
            }
        }

        return response()->json('success');
    }
}

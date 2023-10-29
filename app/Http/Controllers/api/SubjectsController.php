<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $data = subjects::with(['faculty', 'semester'])->paginate(10);

        return response()->json($data);

    }

    public function store(Request $req)
    {

        $count = count($req->subjects);
        if ($count > 0) {

            for ($i = 1; $i < $count; $i++) {
                $new = new subjects();
                $new->semester_id = $req->semester;
                $new->faculty_id = $req->faculty;
                $new->subjects = $req->subjects[$i];
                $new->subjects_code = $req->subjects_code[$i];
                $new->fullmarks = $req->fullMarks[$i];
                $new->passmarks = $req->passMarks[$i];
                $new->practical_fullmarks = $req->p_fullMarks[$i];
                $new->practical_passmarks = $req->p_passMarks[$i];
                $new->creadit_hrs = $req->creadit_hrs[$i];
                $new->save();
            }

            return response()->json(
                [
                    'status' => ' subjects added successfully',
                ]
            );

        } else {
            return response()->json(
                [
                    'status' => ' subjects not found',
                ]
            );
        }

    }

    public function byfaculty($item)
    {
        $data = subjects::with(['faculty', 'semester'])->where('faculty_id', $item)->get();

        return response()->json($data);

    }

    public function delete($id)
    {
        $data = subjects::find($id);
        if ($data->delete()) {
            return response()->json([
                'status' => 'subject deleted',
            ]);
        } else {
            return response()->json([
                'status' => 'subject not deleted',
            ]);
        }
    }
}

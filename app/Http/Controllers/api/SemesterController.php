<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $data = semester::all();

        return response()->json($data);
    }

    public function store(Request $request)
    {

        foreach ($request->classes as $data) {
            if (isset($data)) {
                $new = new semester();
                $new->semester_years = $data;
                $new->save();
            }
        }

        return response()->json([
            'status' => 'Data saved successfully',
        ]);
    }

    public function delete($id)
    {
        $data = semester::find($id);
        if ($data->delete()) {
            return response()->json([
                'status' => 'Data deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'Data not deleted successfully',
            ]);
        }
    }
}

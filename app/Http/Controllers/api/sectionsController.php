<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\section;
use Illuminate\Http\Request;

class sectionsController extends Controller
{
    public function index()
    {
        $data = section::all();

        return response()->json($data);
    }

    public function store(Request $request)
    {

        foreach ($request->sections as $data) {
            if (isset($data)) {
                $new = new section();
                $new->section_name = $data;
                $new->save();
            }
        }

        return response()->json([
            'status' => 'Data saved successfully',
        ]);
    }

    public function delete($id)
    {
        $data = section::find($id);
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

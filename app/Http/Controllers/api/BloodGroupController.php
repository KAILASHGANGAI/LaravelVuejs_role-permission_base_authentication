<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\blood_group;
use Illuminate\Http\Request;

class BloodGroupController extends Controller
{
    public function index()
    {
        $data = blood_group::all();

        return response()->json($data);
    }

    public function store(Request $request)
    {

        foreach ($request->bloods as $data) {
            if (isset($data)) {
                $new = new blood_group();
                $new->blood_group = $data;
                $new->save();
            }
        }

        return response()->json([
            'status' => 'Data saved successfully',
        ]);
    }

    public function delete($id)
    {
        $data = blood_group::find($id);
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

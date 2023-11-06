<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\staff_category;
use Illuminate\Http\Request;

class StaffCategoryController extends Controller
{
    public function index()
    {
        $datas = staff_category::all();

        return response()->json($datas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required | unique:staff_categories',
        ]);

        $new = new staff_category();
        $new->category_name = $request->category_name;

        if ($new->save()) {
            return response()->json([
                'status' => 'Category Added',
            ]);
        }
    }

    public function delete($id)
    {
        $data = staff_category::find($id);
        if ($data->delete()) {
            return response()->json([
                'status' => 'Category Deleted',
            ]);
        }

        return response()->json([
            'status' => 'Category Not Found',
        ]);
    }
}

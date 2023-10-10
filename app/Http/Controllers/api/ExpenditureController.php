<?php

namespace App\Http\Controllers\api;

use App\Models\expenditure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = expenditure::all();
        return response()->json($expense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
           ]);
   
            $expense = new expenditure;
            $expense->details = $request->details;
            $expense->amount = $request->amount;
            $expense->expense_date = date('d/m/y');
            
            $expense->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function show(expenditure $expenditure)
    {
        
       return response()->json($expenditure);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(expenditure $expenditure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenditure $expenditure)
    {
        $update = $expenditure;
        $update->details = $request->details;
        $update->amount = $request->amount;
        if($update->save()){
            return response()->json("success");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenditure $expenditure)
    {
        if($expenditure->delete()){
            return response()->json("successfully deleted");

        }
    }
}

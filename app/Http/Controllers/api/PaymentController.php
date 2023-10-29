<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\payment;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = payment::with(['students', 'students.faculty', 'students.semester', 'students.section'])->get();

        return response()->json($data);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new = new payment();
        $new->user_id = Auth::id();
        $new->students_id = $request->roll_no;
        $new->deposited = $request->deposite;
        $new->discount = $request->discount;
        $new->left_due = $request->left_due;
        $new->payment_method = $request->payment_method;
        $new->fee_type = $request->fee;
        if ($new->save()) {
            return response()->json($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = students::with('payment')->where('id', $id)->first();

        return response()->json($data);
    }

    public function billShow($id)
    {
        $data = students::with('faculty', 'semester', 'section')->where('id', $id)->first();
        $payment = $data->payments->last();

        return response()->json([
            'student' => $data,
            'payments' => $payment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}

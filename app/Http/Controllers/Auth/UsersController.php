<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function register(Request $request){
            $validate = $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users|max:255',
                'password'=> 'required|string|min:8|confirmed'
            ]);

            User::create($validate);
            return response()->json([
                'status'=>1,
                'message'=>'Registration Success'
            ]);
    }
    public function login(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user =User::find(Auth::id()); 
            $token = $user->createToken('token-name')->plainTextToken;
    
            return response()->json([
                'status' => 1,
                'message' => 'Login Success',
                'token' => $token, 
                'username'=>$user->name,
                    'role'=>$user->getRoleNames()
            ]);
        }
 
        return response()->json([
            'status'=>0,
            'message' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(){
        Auth::logout();
 
    session()->invalidate();
    return response()->json([
        'status'=>0,
        'message' => 'Logout Successfully',
    ]);
    }
}

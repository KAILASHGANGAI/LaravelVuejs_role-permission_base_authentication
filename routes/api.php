<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UsersController::class, 'register']);
Route::post('/login', [UsersController::class, 'login']);
Route::get('/logout', [UsersController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/admin/users', [UsersController::class, 'index']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


require_once 'admin_api.php';
require_once 'student_api.php';
require_once 'teacher_api.php';

<?php

use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\NotificationControllers;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
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

Route::get('/notifications', [NotificationControllers::class, 'index']);
Route::get('/notification-read/{id}', [NotificationControllers::class, 'markReas']);
Route::get('/notification-allread', [NotificationControllers::class, 'markReasAll']);

require_once 'admin_api.php';
require_once 'student_api.php';
require_once 'teacher_api.php';

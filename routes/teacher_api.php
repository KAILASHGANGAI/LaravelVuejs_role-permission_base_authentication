<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::controller(NoticesController::class)->group(function () {
        Route::get('/notices', 'index');
        Route::get('/edit-notices/{id}', 'edit');
        Route::patch('/notices/{id}', 'update');
        Route::post('/add-notices', 'store');   
    });
});

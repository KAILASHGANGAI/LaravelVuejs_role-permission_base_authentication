<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/myname', function () {
        return Auth::user();
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.welcome');
});

Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/admin/{pathMatch}', function () {
    return view('admin.welcome');
})->where('any', '.*');

Route::get('/admin/{path1}/{path2}', function () {
    return view('admin.welcome');
})->where('path1', '.*')->where('path2', '.*');

Route::get('/teacher/{pathMatch}', function () {
    return view('admin.welcome');
})->where('any', '.*');

Route::get('/teacher/{path1}/{path2}', function () {
    return view('admin.welcome');
})->where('path1', '.*')->where('path2', '.*');

Route::get('/student/{pathMatch}', function () {
    return view('admin.welcome');
})->where('any', '.*');

Route::get('/student/{path1}/{path2}', function () {
    return view('admin.welcome');
})->where('path1', '.*')->where('path2', '.*');

<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admin.welcome');
});
Route::get('/{any}', function(){ return view('welcome');})->where('pathMatch',".*");
Route::get('/admin/{any}', function(){ return view('admin.welcome');})->where('pathMatch',".*");




<?php

use App\Http\Controllers\api\AssignmentController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\levelManageCon;
use App\Http\Controllers\api\MarksSheetController;
use App\Http\Controllers\api\NoteController;
use App\Http\Controllers\api\NoticesController;
use App\Http\Controllers\api\PeriodController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/facylty/class/section', [levelManageCon::class, 'index']);
    Route::resource('/assignment', AssignmentController::class);
    Route::resource('/notes', NoteController::class);
    Route::post('/notes/update', [NoteController::class, 'update']);
    Route::post('/assignment/update', [AssignmentController::class, 'update']);
    Route::get('/download/assignment/{id}', [AssignmentController::class, 'download']);

    Route::resource('/periods', PeriodController::class)->only(['create']);

    Route::get('/exams/list', [ExamController::class, 'index']);
    Route::post('/routing', [ExamController::class, 'routing']);
    Route::post('/get-students-subjects', [MarksSheetController::class, 'index']);

    Route::post('/store-marks', [MarksSheetController::class, 'store']);
    Route::get('/get-marks-lasers/{id}', [MarksSheetController::class, 'lasers']);
    Route::get('/getclass/details/{id}', [MarksSheetController::class, 'single']);
    Route::get('/notices', [NoticesController::class, 'index']);
});

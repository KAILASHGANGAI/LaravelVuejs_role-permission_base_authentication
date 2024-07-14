<?php

use App\Http\Controllers\api\AssignmentController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\levelManageCon;
use App\Http\Controllers\api\MarksSheetController;
use App\Http\Controllers\api\NoteController;
use App\Http\Controllers\api\NoticesController;
use App\Http\Controllers\api\PeriodController;
use App\Http\Controllers\api\utilityController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\TeachersController;
use App\Models\LeaveManagement;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:student'])->prefix('student')->group(function () {
    Route::get('/get-facylty/class/section', [levelManageCon::class, 'index']);
    Route::resource('/assignment', AssignmentController::class)->only(['index', 'show']);
    Route::resource('/notes', NoteController::class)->only(['index', 'show']);
    Route::get('/download/assignment/{id}', [AssignmentController::class, 'download']);

    Route::resource('/periods', PeriodController::class)->only(['index', 'create', 'show']);

    Route::get('/exams/list', [ExamController::class, 'index']);
    Route::post('/routing', [ExamController::class, 'routing']);
    Route::post('/get-students-subjects', [MarksSheetController::class, 'index']);

    Route::get('/getclass/details/{id}', [MarksSheetController::class, 'single']);
    Route::get('/notices', [NoticesController::class, 'index']);
    Route::get('/attendance', [TeachersController::class, 'attendence']);

    Route::get('/get-marks-lasers/{id}', [MarksSheetController::class, 'lasers']);
    Route::get('/payments', [utilityController::class, 'studentPayment']);

    Route::resource('/leave', LeaveManagementController::class)->only(['index', 'show', 'store', 'update']);
});
Route::get('/download/notes/{id}', [NoteController::class, 'download'])->middleware('auth');

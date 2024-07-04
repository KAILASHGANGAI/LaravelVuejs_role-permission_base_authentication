<?php

use App\Http\Controllers\api\AboutController;
use App\Http\Controllers\api\AssignmentController;
use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\BloodGroupController;
use App\Http\Controllers\api\BookstakenController;
use App\Http\Controllers\api\EventsController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\ExpenditureController;
use App\Http\Controllers\api\FacultyController;
use App\Http\Controllers\api\FacultyMembersController;
use App\Http\Controllers\api\GalleryController;
use App\Http\Controllers\api\guardianController;
use App\Http\Controllers\api\idcardController;
use App\Http\Controllers\api\levelManageCon;
use App\Http\Controllers\api\LibrearyController;
use App\Http\Controllers\api\MarksSheetController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\NoteController;
use App\Http\Controllers\api\NoticesController;
use App\Http\Controllers\api\OwnerDetailsController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\PeriodController;
use App\Http\Controllers\api\QuestionController;
use App\Http\Controllers\api\sectionsController;
use App\Http\Controllers\api\SemesterController;
use App\Http\Controllers\api\SlidersController;
use App\Http\Controllers\api\StaffCategoryController;
use App\Http\Controllers\api\StaffController;
use App\Http\Controllers\api\StudentsController;
use App\Http\Controllers\api\SubjectsController;
use App\Http\Controllers\api\TakeatdController;
use App\Http\Controllers\api\TestimonialsController;
use App\Http\Controllers\api\utilityController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\NotificationControllers;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherLeaveManagementController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'role:admin|Super-Admin|accountent'])->group(function () {
    Route::resource('/payment', PaymentController::class);
    Route::resource('/expenditure', ExpenditureController::class);
    Route::get('/payment/bill/{id}', [PaymentController::class, 'billShow']);
    Route::get('/get-payment-records', [PaymentController::class, 'index']);

    Route::post('/general-details', [OwnerDetailsController::class, 'store']);
    Route::put('/general-details/{id}', [OwnerDetailsController::class, 'update']);
    Route::get('/general-details', [OwnerDetailsController::class, 'index']);
    Route::get('/general-details', [utilityController::class, 'owner']);
});

Route::middleware(['auth:sanctum', 'role:admin|Super-Admin'])->group(function () {
    Route::get('/detailed-summery', [utilityController::class, 'summery']);

    Route::get('/student/facylty/class/section', [levelManageCon::class, 'index']);

    Route::resource('/students', StudentsController::class);
    Route::resource('/guardian', guardianController::class);
    Route::resource('/staffs', StaffController::class);
    Route::get('/staff-category/index', [StaffCategoryController::class, 'index']);
    Route::delete('/staff-category/{id}/delete', [StaffCategoryController::class, 'delete']);
    Route::post('/staff-category/store', [StaffCategoryController::class, 'store']);
    Route::resource('/periods', PeriodController::class);

    Route::resource('/create-attendance', TakeatdController::class);
    Route::resource('/attendance', AttendanceController::class);
    Route::post('/attendance/students/bymonth', [AttendanceController::class, 'bymonth']);

    Route::post('/attendance/teacher', [TeacherAttendanceController::class, 'store']);
    Route::get('/attendance/teacher/list', [TeacherAttendanceController::class, 'index']);
    Route::post('/attendance/teacher/bydate', [TeacherAttendanceController::class, 'search']);
    Route::post('/attendance/teacher/bymonth', [TeacherAttendanceController::class, 'bymonth']);




    Route::resource('/libreary', LibrearyController::class);
    Route::post('/show-books-list', [BookstakenController::class, 'getBooks']);
    Route::post('/show-student-detail', [BookstakenController::class, 'getstudent']);
    Route::post('/save-books-taken', [BookstakenController::class, 'saveBooks']);
    Route::post('/show-books-taken', [BookstakenController::class, 'showBooks']);
    Route::post('/return-books-taken', [BookstakenController::class, 'returnBooks']);

    Route::resource('/assignment', AssignmentController::class);
    Route::resource('/notes', NoteController::class);
    Route::post('/notes/update', [NoteController::class, 'update']);
    Route::post('/assignment/update', [AssignmentController::class, 'update']);
    Route::get('/download/assignment/{id}', [AssignmentController::class, 'download']);
    Route::resource('/exams', ExamController::class);
    Route::post('/routing', [ExamController::class, 'routing']);
    Route::resource('/questions', QuestionController::class);
    Route::post('/getquestions', [QuestionController::class, 'getquestions']);
    Route::post('/getstudents-details', [idcardController::class, 'idcard']);


    // website controlling roures
    Route::controller(SlidersController::class)->group(function () {
        Route::get('/slider', 'index');
        Route::get('/edit-slider/{id}', 'edit');
        Route::patch('/slider/{id}', 'update');
        Route::delete('/slider/{id}', 'delete');
        Route::post('/add-slider', 'store');
    });
    Route::controller(TestimonialsController::class)->group(function () {
        Route::get('/testimonials', 'index');
        Route::get('/edit-testimonials/{id}', 'edit');
        Route::patch('/testimonials/{id}', 'update');
        Route::delete('/testimonials/{id}', 'delete');
        Route::post('/add-testimonials', 'store');
    });
    Route::controller(AboutController::class)->group(function () {
        Route::get('/about', 'index');
        Route::get('/edit-about/{id}', 'edit');
        Route::patch('/about/{id}', 'update');
        Route::delete('/about/{id}', 'delete');
        Route::post('/add-about', 'store');
    });
    Route::controller(EventsController::class)->group(function () {
        Route::get('/events', 'index');
        Route::get('/edit-events/{id}', 'edit');
        Route::get('/publish-events/{id}', 'publish');
        Route::patch('/events/{id}', 'update');
        Route::delete('/events/{id}', 'delete');
        Route::post('/add-events', 'store');
    });
    Route::controller(NewsController::class)->group(function () {
        Route::get('/news', 'index');
        Route::get('/edit-news/{id}', 'edit');
        Route::patch('/news/{id}', 'update');
        Route::delete('/news/{id}', 'delete');
        Route::post('/add-news', 'store');
    });
    Route::controller(NoticesController::class)->group(function () {
        Route::get('/notices', 'index');
        Route::get('/edit-notices/{id}', 'edit');
        Route::patch('/notices/{id}', 'update');
        Route::delete('/notices/{id}', 'delete');
        Route::post('/add-notices', 'store');
    });
    Route::controller(FacultyMembersController::class)->group(function () {
        Route::get('/faculty-members', 'index');
        Route::get('/edit-faculty-members/{id}', 'edit');
        Route::patch('/faculty-members/{id}', 'update');
        Route::delete('/faculty-members/{id}', 'delete');
        Route::post('/add-faculty-members', 'store');
    });

    Route::post('/faculties', [FacultyController::class, 'store']);
    Route::get('/faculties', [FacultyController::class, 'index']);
    Route::delete('/faculties/{id}', [FacultyController::class, 'destroy']);

    Route::post('/classes', [SemesterController::class, 'store']);
    Route::get('/classes', [SemesterController::class, 'index']);
    Route::delete('/classes/{id}', [SemesterController::class, 'delete']);

    Route::post('/sections', [sectionsController::class, 'store']);
    Route::get('/sections', [sectionsController::class, 'index']);
    Route::delete('/sections/{id}', [sectionsController::class, 'delete']);

    Route::post('/bloods', [BloodGroupController::class, 'store']);
    Route::get('/bloods', [BloodGroupController::class, 'index']);
    Route::delete('/bloods/{id}', [BloodGroupController::class, 'delete']);

    Route::post('/gallery', [GalleryController::class, 'store']);

    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::delete('/gallery/{id}', [GalleryController::class, 'delete']);


    Route::post('/subjects', [SubjectsController::class, 'store']);
    Route::get('/subjects', [SubjectsController::class, 'index']);
    Route::get('/subjects/faculty=/{item}', [SubjectsController::class, 'byfaculty']);
    Route::get('/subjects/delete/{id}', [SubjectsController::class, 'delete']);

    Route::post('/get-students-subjects', [MarksSheetController::class, 'index']);

    Route::post('/store-marks', [MarksSheetController::class, 'store']);
    Route::get('/get-marks-lasers/{id}', [MarksSheetController::class, 'lasers']);
    Route::get('/getclass/details/{id}', [MarksSheetController::class, 'single']);
    Route::resource('/student-leave', LeaveManagementController::class);
    Route::resource('/teacher-leave', TeacherLeaveManagementController::class);

});
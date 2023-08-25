<?php

    use App\Http\Controllers\Admin\LecturerController as LecturerControllerAlias;
    use App\Http\Controllers\Admin\StudentController as StudentControllerAlias;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\LecturerController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    //api lecturer
    Route::get('/api-index',[StudentController::class,'api'])->name('api.lecturer.api');
    Route::post('/api-attendance',[LecturerController::class,'attendance'])->name('api.lecturer.attendance');
    Route::post('/api-get-num-weeks',[LecturerController::class,'numWeeks'])->name('api.lecturer.getNumWeeks');
    Route::get('/api-check-condition',[StudentController::class,'check_condition'])->name('api.lecturer.check_condition');

    //api admin
    Route::get('/api-student',[StudentControllerAlias::class,'api_students'])->name('api.admin.api_students');
    Route::get('/api-lecturer',[LecturerControllerAlias::class,'api_lecturers'])->name('api.admin.api_lecturers');
    Route::get('/api-course',[CourseController::class,'api_courses'])->name('api.admin.api_courses');
    Route::get('/api-subject',[SubjectController::class,'api_subjects'])->name('api.admin.api_subjects');
    Route::post('/api-get-course',[CourseController::class,'api_get_course'])->name('api.admin.get_course');
    Route::post('/api-get-student/{id}',[StudentController::class,'api_get_student'])->name('api.admin.get_student');



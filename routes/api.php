<?php

    use App\Http\Controllers\LecturerController;
    use App\Http\Controllers\StudentController;
    use Illuminate\Http\Request;
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
    Route::get('/api-index',[StudentController::class,'api'])->name('api.lecturer.api');
    Route::post('/api-attendance',[LecturerController::class,'attendance'])->name('api.lecturer.attendance');
    Route::post('/api-get-num-weeks',[LecturerController::class,'numWeeks'])->name('api.lecturer.getNumWeeks');
    Route::get('/api-check-condition',[StudentController::class,'check_condition'])->name('api.lecturer.check_condition');



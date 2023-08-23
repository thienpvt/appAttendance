<?php

    use App\Http\Controllers\LecturerController;
    use App\Http\Controllers\StudentController;
    use Illuminate\Support\Facades\Route;

    Route::get('/',[LecturerController::class,'index']);
    Route::get('/check-condition',[LecturerController::class,'check_condition']);



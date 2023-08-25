<?php

    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\LecturerController;
    use App\Http\Controllers\Admin\StudentController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\SubjectController;
    use Illuminate\Support\Facades\Route;

    Route::get('/',[AdminController::class,'index'])->name('index');

    Route::group([
        'as'     => 'lecturer.',
        'prefix' => 'lecturer',
    ], static function () {
        Route::get('/', [LecturerController::class, 'index'])->name('index');
        Route::get('/create', [LecturerController::class, 'create'])->name('create');
        Route::post('/create', [LecturerController::class, 'store'])->name('store');
        Route::get('/{user}', [LecturerController::class, 'show'])->name('show');
        Route::delete('/{user}', [LecturerController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'as'     => 'student.',
        'prefix' => 'student',
    ], static function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/create', [StudentController::class, 'store'])->name('store');
        Route::get('/edit', [StudentController::class, 'edit'])->name('edit');
        Route::post('/update', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });
    Route::group([
        'as'     => 'course.',
        'prefix' => 'course',
    ], static function () {
        Route::get('/',[CourseController::class,'index']);
        Route::get('/create',[CourseController::class,'create'])->name('create');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::get('/edit', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'store'])->name('destroy');
    });
    Route::group([
        'as'     => 'subject.',
        'prefix' => 'subject',
    ], static function () {
        Route::get('/',[SubjectController::class,'index']);
        Route::get('/create',[SubjectController::class,'create'])->name('create');
        Route::post('/store', [SubjectController::class, 'store'])->name('store');
        Route::post('/edit', [SubjectController::class, 'edit'])->name('edit');
        Route::post('/store', [SubjectController::class, 'store'])->name('store');
        Route::delete('/{subject}', [SubjectController::class, 'store'])->name('destroy');
    });

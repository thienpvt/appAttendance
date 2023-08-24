<?php

    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [AuthController::class,'login'])->name('login');
    Route::post('/', [AuthController::class,'processLogin'])->name('processLogin');
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'processRegister'])->name('processRegister');


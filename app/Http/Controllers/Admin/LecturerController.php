<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class LecturerController extends Controller
{
    use ResponseTrait;
    private object $model;
    public function __construct()
    {
        $this->model = User::query();
        $routeName   = Route::currentRouteName();
        $arr         = explode('.', $routeName);
        $arr         = array_map('ucfirst', $arr);
        $title       = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index()
    {
        $lecturers=$this->model
            ->where('level',UserRoleEnum::lecturer)
            ->paginate(20);
        return view('admin.lecturers.index',[
            'lecturers' => $lecturers
        ]);
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store( $request)
    {

    }

    public function edit(User $lecturer)
    {
        return view('admin.lecturers.edit',[
            'lecturer' => $lecturer
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreLecturerRequest;
use App\Http\Requests\UpdateLecturerRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function store(StoreLecturerRequest $request)
    {
        $arr       = $request->validated();
        $arr['avatar'] = optional($request->file('avatar'))->store('lecturers/'.$request->id);
        $arr['password']=Hash::make($request->get('password'));
        $lecturer= $this->model->create($arr);
        if(!$lecturer){
            return $this->errorResponse();
        }
        return $this->successResponse();

    }

    public function edit(User $lecturer)
    {
        return view('admin.lecturers.edit',[
            'lecturer' => $lecturer
        ]);
    }

    public function update(UpdateLecturerRequest $request,$lecturerId)
    {
        try {
            $arr       = $request->validated();
            $arr['avatar'] = optional($request->file('avatar'))->store('lecturers/'.$request->id);
            $arr['password']=optional(Hash::make($request->get('password')));
            $lecturer = $this->model->find($lecturerId);
            $lecturer->fill($arr);
            $lecturer->save();
            return $this->successResponse();
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }

    }

    public function destroy($lecturerId)
    {
        $lecturer=  $this->model->find($lecturerId)->delete();
        if(!$lecturer) {
            return $this->errorResponse();
        }
        return $this->successResponse();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    use ResponseTrait;
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Student::query();
        $routeName   = Route::currentRouteName();
        $arr         = explode('.', $routeName);
        $arr         = array_map('ucfirst', $arr);
        $title       = implode(' - ', $arr);
        View::share('title', $title);
    }
    public function index()
    {
        $courses=Course::get();
        return view('admin.student.index',[
            'courses'=>$courses
        ]);
    }

    public function api_students()
    {
        return DataTables::of($this->model->with('course'))
            ->addColumn('course_name',function($each){
                return $each->course->name;
            })
            ->addColumn('edit',function($each){
                return route('api.admin.get_student',$each->id);
            })
            ->addColumn('destroy',function($each){
                return route("admin.students.destroy",$each);
            })
            ->filterColumn('course_name', function ($query, $keyword) {
                if ($keyword !== 'null') {
                    $query->whereHas('course', function ($q) use ($keyword) {
                        return $q->where('id', $keyword);
                    });
                }
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $student = $this->model->create($request->validated());
        if(!$student) {
            return $this->errorResponse();
        }
        return $this->successResponse();
    }

    public function update(UpdateStudentRequest $request)
    {
        try {
            $student = $this->model->find($request->get('id'));
            $student->fill($request->validated());
            $student->save();
            return $this->successResponse();
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($StudentID)
    {

        $student=  $this->model->find($StudentID)->delete();
        if(!$student) {
            return $this->errorResponse();
        }
        return $this->successResponse();

    }

}

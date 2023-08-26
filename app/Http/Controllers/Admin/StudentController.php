<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Course;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
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
        $this->table = (new Student())->getTable();
        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
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

    public function update(UpdateStudentRequest $request)
    {
        try {
            $object = $this->model->find($request->get('id'));
            $object->fill($request->validated());
            $object->save();
            return $this->successResponse();
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($StudentID)
    {
        try {
            $this->model->find($StudentID)->delete();
            return $this->successResponse();
        } catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

}

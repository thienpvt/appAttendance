<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class StudentController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Student::query();
        $this->table = (new Student())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function api(Request $request)
    {
        $course_id = $request->get('course_id');
        $subject_id = $request->get('subject_id');
        $week=$request->get('week');
        $attendance=Attendance::query()
            ->where('course_id',$course_id)
            ->where('subject_id',$subject_id)
            ->where('week',$week)
            ->first();
        if (isset($attendance)){
            return DataTables::of($this->model->with('attendanceDetails')->where('course_id',$course_id))
                ->addColumn('attendance_point',function($each){
                    return $each->attendanceDetails->point;
                })
                ->make(true);
        }
        return DataTables::of($this->model->with('attendanceDetails')->where('course_id',$course_id))
            ->addColumn('attendance_point',null)
            ->make(true);
    }
    public function check_condition(Request $request)
    {
        $course_id = $request->get('course_id');
        $subject_id = $request->get('subject_id');
        $week=$request->get('week');
        $numberWeek=DB::table('attendances')
            ->distinct('week')
            ->count('week')
        ;
        dd($numberWeek);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

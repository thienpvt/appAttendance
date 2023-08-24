<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Attendance_detail;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use function MongoDB\BSON\toJSON;


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
            ->first();
        if (isset($attendance)){
            return DataTables::of($this->model->where('course_id',$course_id))
                ->addColumn('attendance_point',function($each) use ($attendance,$week){
                    $attendance_detail=Attendance_detail::query()->get()
                        ->where('attendance_id','=',$attendance->id)
                        ->where('student_id','=',$each->id)
                        ->where('week',$week)
                        ->first();
                    if (isset($attendance_detail)) return $attendance_detail->point;
                    return null;
                })
                ->make(true);
        }
        return DataTables::of($this->model->where('course_id',$course_id))
            ->addColumn('attendance_point',null)
            ->make(true);
    }

    public function check_condition(Request $request)
    {
        $course_id = $request->get('course_id');
        $subject_id = $request->get('subject_id');
        $week=$request->get('week');

        $attendance=Attendance::query()
            ->where('course_id',$course_id)
            ->where('subject_id',$subject_id)
            ->get('id')
        ;
        $numWeeks=DB::table('attendance_details')
            ->distinct('week')
        ->where('attendance_id',$attendance);
        if (isset($attendance)){
            return DataTables::of($this->model->with('point')->where('course_id',$course_id))
                ->with('num_weeks',$numWeeks)
                ->addColumn('totalPoint',function ($each)use ($attendance){
                    return Attendance_detail::query()
                        ->sum('point')
                        ->where('attendance_id',$attendance)
                        ->where('student_id',$each->id);
                })
                ->addColumn('idas',function ($each){
                    return $each->point;
                })
                ->make(true)
                ;
        }
        return DataTables::of($this->model->with('totalPoints')->where('course_id',$course_id))
            ->addColumn('totalPoints',null)
            ->make(true)
            ;
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

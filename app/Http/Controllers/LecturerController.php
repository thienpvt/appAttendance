<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Attendance_detail;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class LecturerController extends Controller
{
    //
    use ResponseTrait;
    public function __construct()
    {
        View::share('title','Lecturer');
    }
    public function index(){
        $courses=Course::get();
        $subjects=Subject::get();
        return view('lecturer.index',[
            'courses' => $courses,
            'subjects' => $subjects,
        ]);
    }

    public function attendance(Request $request)
    {
        $course_id = $request->get('course_id');
        $subject_id = $request->get('subject_id');
        $week=$request->get('week');
        $attendances=$request->get('attendances');
        \DB::beginTransaction();
        try {
            $attendance=Attendance::firstOrCreate([
                'course_id' => $course_id,
                'subject_id' => $subject_id,
                'week' => $week,
            ]);
            foreach($attendances as $student_id => $point){
                Attendance_detail::updateOrCreate([
                    'attendance_id'=>$attendance->id,
                    'student_id'=>$student_id,
                ],[
                    'point'=>$point,
                ]);
            }
            DB::commit();
            return $this->successResponse();
        }catch (\Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }
}

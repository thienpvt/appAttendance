<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function attendanceDetails()
    {
        return $this->hasOne(Attendance_detail::class,'student_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;
    public function totalPoints(): HasMany
    {
        return $this->hasMany(Attendance_detail::class,'student_id');
    }

    public function point(): HasOne
    {
        return $this->hasOne(Attendance_detail::class,
            ['student_id','attendance_id'])
        ;
    }
}

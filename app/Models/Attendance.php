<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'week',
        'course_id',
        'subject_id'
    ];
}

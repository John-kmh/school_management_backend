<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTeacher extends Pivot
{
    protected $table = 'course_teacher';
    protected $fillable = ['course_id', 'user_id'];
}

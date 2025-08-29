<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', 'course_name', 'description', 'is_active'];

    // Students
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    // Teachers
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_teacher');
    }

    // Learning activities
    public function learningActivities()
    {
        return $this->hasMany(LearningActivity::class);
    }

    // Attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Course;
use App\Models\ActionLog;
use App\Models\Attendance;
use App\Models\Information;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ActivitySubmission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username', 'fullname', 'email', 'password',
        'phone', 'address', 'gender', 'birth_date', 'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Students: enrolled courses
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    // Teachers: assigned courses
    public function teachingCourses()
    {
        return $this->belongsToMany(Course::class, 'course_teacher');
    }

    // Activity submissions
    public function activitySubmissions()
    {
        return $this->hasMany(ActivitySubmission::class, 'user_id');
    }

    // Attendance records
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    // Action logs
    public function actionLogs()
    {
        return $this->hasMany(ActionLog::class, 'user_id');
    }

    // Information posted by user
    public function informations()
    {
        return $this->hasMany(Information::class, 'user_id');
    }


}

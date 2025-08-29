<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ActivitySubmission extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'learning_activity_id', 'user_id',
        'submission_text', 'submitted_at',
        'score', 'feedback'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function learningActivity()
    {
        return $this->belongsTo(LearningActivity::class);
    }
}

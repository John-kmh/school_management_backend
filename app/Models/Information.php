<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'is_active'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

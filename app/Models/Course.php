<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // import the User model

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'title',
        'description',
        'trainer_id',
        'duration',
    ];

    // Automatically append trainer_name to JSON
    protected $appends = ['trainer_name'];

    // DEFINE RELATIONSHIP
    public function trainer()
    {
        // This tells Laravel: Course belongs to a User via trainer_id
        return $this->belongsTo(User::class, 'trainer_id')
                    ->where('role_id', 4); // only users with role_id = 4
    }

    // ACCESSOR to get trainer name
    public function getTrainerNameAttribute()
    {
        // trainer?->name works safely even if trainer is null
        return $this->trainer?->name;
    }
}

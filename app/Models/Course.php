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
        'course_status_id',
    ];

   
    protected $appends = ['trainer_name'];

    
    public function trainer()
    {
      
        return $this->belongsTo(User::class, 'trainer_id')
                    ->where('role_id', 4); 
    }

    
    public function getTrainerNameAttribute()
    {
       
        return $this->trainer?->name;
    }

    public function lessons()
{
    return $this->hasMany(Lesson::class)->orderBy('lesson_order');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'teacher_id', 'course_id'
    ];

    /**
     * The teacher that belong to the course.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the course that owns the Activity.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

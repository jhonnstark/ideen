<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz', 'type', 'exam_id'
    ];

    /**
     * The teacher that belong to the course.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}

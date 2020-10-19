<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
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

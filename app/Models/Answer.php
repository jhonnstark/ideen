<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static first(mixed $claim)
 * @method static find(mixed $claim)
 */
class Answer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option', 'correct', 'question_id'
    ];

    /**
     * The teacher that belong to the course.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

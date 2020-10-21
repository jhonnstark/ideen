<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profess', 'user_id', 'question_id'
    ];

    /**
     * Get the state that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The teacher that belong to the course.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

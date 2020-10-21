<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'ext', 'size', 'user_id', 'activity_id'
    ];

    /**
     * Get the state that owns the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the state that owns the user.
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

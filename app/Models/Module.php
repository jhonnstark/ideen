<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static find($input)
 * @property mixed id
 */
class Module extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'course_id'
    ];

    /**
     * Get the content for the course.
     */
    public function content(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Get the course that owns the module.
     */
    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the activity for the course.
     */
    public function activity(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Activity::class);
    }
}

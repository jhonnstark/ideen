<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $validated)
 * @method static find($input)
 * @property mixed id
 * @property mixed exams
 * @property mixed course_id
 * @property mixed activity
 * @property mixed content
 * @property mixed material
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
     *
     * @return HasMany
     */
    public function content(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Get the course that owns the module.
     *
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the activity for the course.
     *
     * @return HasMany
     */
    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get the activity for the course.
     *
     * @return HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}

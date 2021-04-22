<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @method static find($course_id)
 * @property mixed module
 * @property mixed student
 */
class Course extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'poster', 'category_id', 'level_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['poster'];

    /**
     * Get the url for the poster of the course.
     */
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url('poster/' . $this->poster);
    }

    /**
     * Get the url for the poster of the course.
     */
    public function getUrlBigAttribute()
    {
        return Storage::disk('s3')->url('poster_big/' . $this->poster);
    }

    /**
     * Get the category that owns the course.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the category that owns the course.
     *
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * The teacher that belong to the course.
     *
     * @return belongsToMany
     */
    public function teacher(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'lecturings');
    }

    /**
     * The student that belong to the course.
     *
     * @return BelongsToMany
     */
    public function student(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'learnings');
    }

    /**
     * Get the activity for the course.
     *
     * @return HasMany
     */
    public function module(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Get the activity for the course.
     *
     * @return HasMany
     */
    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}

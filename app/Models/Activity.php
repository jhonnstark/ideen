<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Activity extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'course_id', 'description'
    ];

    /**
     * The student that belong to the Activity.
     */
    public function material()
    {
        return $this->belongsToMany(Material::class);
    }

    /**
     * Get the course that owns the Activity.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

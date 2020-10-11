<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 */
class Content extends Model
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
     * The student that belong to the course.
     */
    public function material()
    {
        return $this->belongsToMany(Material::class);
    }
}

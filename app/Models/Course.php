<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'category_id', 'level_id'
    ];

    /**
     * Get the category that owns the course.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the category that owns the course.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * The teacher that belong to the course.
     */
    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'lecturings');
    }

    /**
     * The student that belong to the course.
     */
    public function student()
    {
        return $this->belongsToMany(User::class, 'learnings');
    }

    /**
     * Get the content for the course.
     */
    public function content()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Get the activity for the course.
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}

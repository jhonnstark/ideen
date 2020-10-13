<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
     * Get the url for the poster of the course.
     */
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url('poster/' . $this->poster);
    }

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

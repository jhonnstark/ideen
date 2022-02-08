<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed score
 * @property mixed homework
 * @property mixed id
 * @property mixed payments
 * @property mixed $courses
 * @method static create(array $record)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'mothers_lastname', 'email', 'password', 'deactivated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user profile record associated with the user.
     *
     * @return HasOne
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * The course that belong to the user.
     *
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'learnings');
    }

    /**
     * Get the homework record associated with the user.
     *
     * @return HasMany
     */
    public function homework(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    /**
     * Get the scores record associated with the user.
     *
     * @return HasMany
     */
    public function score(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Get the scores record associated with the user.
     *
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

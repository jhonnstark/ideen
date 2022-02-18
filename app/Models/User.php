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
 * @property mixed $deactivated_at
 * @property mixed $lastname
 * @property mixed $name
 * @property mixed $mothers_lastname
 * @property mixed $bills
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
        'name',
        'lastname',
        'mothers_lastname',
        'email',
        'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function toggleSuspend(): void
    {
        if (is_null($this->deactivated_at)) {
            $this->deactivated_at = now();
        } else {
            $this->deactivated_at = null;
        }
        $this->save();
    }

    /**
     * Get the user profile record associated with the user.
     *
     * @return HasOne
     */
    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class)->withDefault([
            'birthday' => null,
        ]);
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
     * @return HasOne
     */
    public function payments(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the scores record associated with the user.
     *
     * @return HasMany
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return is_null($this->deactivated_at);
    }

    /**
     * The material that belong to the user.
     *
     * @return BelongsToMany
     */
    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'certificates');
    }
}

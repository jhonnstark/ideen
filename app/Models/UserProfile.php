<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birthday',
        'age',
        'address',
        'state_id',
        'user_id',
        'phone',
        'enrollment',
        'birth_certificate',
        'school_certificate',
        'curp_certificate',
        'municipality',
        'birthplace',
        'emergency_phone',
        'facebook',
        'curp',
    ];

    /**
     * Get the state that owns the user.
     *
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the state that owns the user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

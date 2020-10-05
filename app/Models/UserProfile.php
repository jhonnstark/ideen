<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birthday', 'gender', 'age', 'address', 'address_ext', 'state_id',
        // 'user_id'
    ];

    /**
     * Get the state that owns the user.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

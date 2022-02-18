<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $url
 * @property \Illuminate\Support\Carbon|mixed $paid_at
 * @property mixed $user_id
 * @property mixed $id
 */
class Bill extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'discount', 'price', 'total'
    ];
}

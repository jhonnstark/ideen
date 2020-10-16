<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profess', 'user_id', 'question_id'
    ];
}

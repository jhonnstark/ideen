<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mark', 'exam_id', 'user_id', 'finish_at'
    ];
}

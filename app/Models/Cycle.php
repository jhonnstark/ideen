<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($validated)
 * @property mixed $id
 */
class Cycle extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}

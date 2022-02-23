<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(mixed $concept_id)
 * @method static create(array $record)
 * @property mixed $id
 */
class Concept extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'total'
    ];
}

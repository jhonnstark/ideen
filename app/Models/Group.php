<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @method static where(string $string, mixed $program)
 * @property mixed $users
 */
class Group extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'quarter', 'period', 'program_id', 'cycle_id'
    ];

    /**
     * The student that belong to the course.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the program that owns the group.
     *
     * @return BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the program that owns the group.
     *
     * @return BelongsTo
     */
    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }
}

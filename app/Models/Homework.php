<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @property mixed material
 * @property mixed score
 */
class Homework extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'description', 'activity_id', 'score'
    ];

    /**
     * Get the state that owns the user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activity that owns the homework.
     *
     * @return BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * The material that belong to the homework.
     *
     * @return BelongsToMany
     */
    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}

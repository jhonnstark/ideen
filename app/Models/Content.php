<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @property mixed material
 */
class Content extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'module_id', 'description', 'close_at', 'active_at'
    ];

    /**
     * The student that belong to the course.
     *
     * @return BelongsToMany
     */
    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

    /**
     * Get the course that owns the Activity.
     *
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $validated)
 * @property mixed module_id
 * @property mixed active_at
 * @property mixed close_at
 * @property mixed id
 * @property mixed homework
 */
class Activity extends Model
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['active'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getActiveAttribute(): string
    {
        $today = Carbon::now();
        if ($today->between($this->active_at, $this->close_at)) {
            return "Activo";
        }
        return "Expirado";
    }

    /**
     * The student that belong to the Activity.
     *
     * @return BelongsToMany
     */
    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

    /**
     * Get the module that owns the Activity.
     *
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Get the homework that owns the Activity.
     *
     * @return HasMany
     */
    public function homework(): HasMany
    {
        return $this->hasMany(Homework::class);
    }
}

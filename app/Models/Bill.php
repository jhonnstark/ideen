<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $url
 * @property \Illuminate\Support\Carbon|mixed $paid_at
 * @property mixed $user_id
 * @property mixed $id
 * @method static where(string $string, string $string1, mixed $start)
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

    /**
     * Get the user that owns the payment.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property mixed $id
 * @property mixed $url
 * @property mixed $user_id
 * @property Carbon|mixed $paid_at
 * @method static create($record)
 */
class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'discount', 'price', 'total', 'paid_at', 'user_id'
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

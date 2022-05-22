<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin Builder
 */
class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:M d, Y'
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class, 'customer_id');
    }

    // scope to check if authenticated user has access to the customer
    public function scopeAuthUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
}

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
}

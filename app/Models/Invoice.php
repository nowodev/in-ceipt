<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin Builder
 */
class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoice_details(): HasMany
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // scope to check if authenticated user has access to the invoice
    public function scopeAuthUser($query)
    {
        return $query->where('user_id', auth()->id());
    }
}

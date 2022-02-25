<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create(array $array)
 * @method static get()
 * @method static paginate(int $int)
 */
class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoice_details(): HasMany
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

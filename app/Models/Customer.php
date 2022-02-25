<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static get()
 * @method static paginate(int $int)
 */
class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    protected $casts = [
      'created_at' => 'date:M d, Y'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin Builder
 */
class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
}

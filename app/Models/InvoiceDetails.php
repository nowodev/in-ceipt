<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static where(string $string, $desc)
 */
class InvoiceDetails extends Model
{
    use HasFactory;

    protected $guarded = [];
}

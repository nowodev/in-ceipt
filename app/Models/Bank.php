<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class Bank extends Model
{
    use HasFactory;

    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(Setting::class);
    }
}

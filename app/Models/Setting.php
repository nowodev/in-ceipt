<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class);
    }
}

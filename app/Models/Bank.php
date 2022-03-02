<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    use HasFactory;

    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(Setting::class);
    }
}

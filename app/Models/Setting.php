<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class);
    }
}

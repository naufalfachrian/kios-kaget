<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public function province(): BelongsTo {
        return $this->belongsTo(Province::class);
    }

    public function districts(): HasMany {
        return $this->hasMany(District::class);
    }

    public function postalCodes(): HasMany {
        return $this->hasMany(PostalCode::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubDistrict extends Model
{
    use HasFactory;

    public function district(): BelongsTo {
        return $this->belongsTo(District::class);
    }

    public function postalCodes(): HasMany {
        return $this->hasMany(PostalCode::class);
    }
}

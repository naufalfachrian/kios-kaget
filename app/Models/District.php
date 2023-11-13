<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }

    public function subDistricts(): HasMany {
        return $this->hasMany(SubDistrict::class);
    }

    public function postalCodes(): HasMany {
        return $this->hasMany(PostalCode::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;

    public function province(): HasOne {
        return $this->hasOne(Province::class);
    }

    public function districts(): HasMany {
        return $this->hasMany(District::class);
    }

    public function postalCodes(): HasMany {
        return $this->hasMany(PostalCode::class);
    }
}

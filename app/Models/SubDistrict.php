<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubDistrict extends Model
{
    use HasFactory;

    public function district(): HasOne {
        return $this->hasOne(District::class);
    }

    public function postalCodes(): HasMany {
        return $this->hasMany(PostalCode::class);
    }
}

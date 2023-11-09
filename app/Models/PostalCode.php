<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostalCode extends Model
{
    use HasFactory;

    public function province(): HasOne {
        return $this->hasOne(Province::class);
    }

    public function city(): HasOne {
        return $this->hasOne(City::class);
    }

    public function district(): HasOne {
        return $this->hasOne(District::class);
    }

    public function subDistrict(): HasOne {
        return $this->hasOne(SubDistrict::class);
    }
}

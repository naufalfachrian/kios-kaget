<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'recipient_name',
        'address',
        'sub_district_id',
        'district_id',
        'city_id',
        'province_id',
        'postal_code',
        'phone_number',
        'landmark',
    ];

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}

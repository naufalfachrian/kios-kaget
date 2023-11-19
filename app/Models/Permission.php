<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    use HasFactory;

    static $PRODUCT_MASTER = "PRODUCT_MASTER";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

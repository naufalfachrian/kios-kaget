<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    use HasUuids, HasFactory;

    static $PRODUCT_MASTER = "PRODUCT_MASTER";

    static $ADMINISTRATOR_ACCESS = "ADMINISTRATOR_ACCESS";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

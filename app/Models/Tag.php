<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'tag_group_id',
        'name',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(TagGroup::class);
    }
}

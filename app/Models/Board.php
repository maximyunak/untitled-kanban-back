<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    protected $fillable = [
        "name",
        "description",
        "user_id"
    ];

    public function columns(): HasMany
    {
        return $this->hasMany(Column::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

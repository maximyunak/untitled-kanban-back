<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        "name",
        "description",
        "is_completed",
        "position",
        "deadline",

        "creator_id",
        "assignee_id",
        "column_id",
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}

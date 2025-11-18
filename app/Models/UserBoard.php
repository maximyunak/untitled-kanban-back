<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBoard extends Model
{
    protected $fillable = [
        "user_id",
        "board_id",
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function boards()
    {
        return $this->belongsTo(Board::class);
    }
}

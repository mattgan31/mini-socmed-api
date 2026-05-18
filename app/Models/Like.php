<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Attributes\Hidden;

#[Hidden(['id'])]
class Like extends Model
{
    protected $fillable = [
        'user_id'
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

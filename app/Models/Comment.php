<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['content', 'user_id', 'post_id'])]
class Comment extends Model
{
    protected $hidden = [
        'id',
        'post_id'
    ];

    protected static function booted(): void
    {
        static::creating(function ($comment) {
            if (!$comment->ulid) {
                $comment->ulid = (string) Str::ulid();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['content', 'user_id', 'post_id', 'parent_id'])]
class Comment extends Model
// TODO parent_id (nullable) for comment the comment
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

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }
}

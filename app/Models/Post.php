<?php

namespace App\Models;

use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Support\Str;

#[Fillable(['content', 'user_id'])]
#[Hidden(['id'])]
class Post extends Model
{
    // use HasUlids;

    protected $hidden = [
        'id',
    ];

    protected static function booted(): void
    {
        static::creating(function ($post) {

            if (!$post->ulid) {
                $post->ulid = (string) Str::ulid();
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function likesCount(): int
    {
        return $this->likes()->count();
    }
}

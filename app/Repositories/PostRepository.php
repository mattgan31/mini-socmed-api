<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    public function all()
    {
        return Post::with(['user'])->withCount(['likes'])->withExists(['likes as is_liked' => function ($q) {
            $q->where('user_id', Auth::id());
        }])->latest()->paginate(10);
    }

    public function findByUlid(string $ulid)
    {
        return Post::with(['user',])->withCount(['likes'])->withExists(['likes as is_liked' => function ($q) {
            $q->where('user_id', Auth::id());
        }])->where('ulid', $ulid)->firstOrFail();
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(array $data, string $ulid): Post
    {
        $post = Post::where('ulid', $ulid)->firstOrFail();

        $post->update($data);

        return $post;
    }

    public function delete(string $ulid)
    {
        return Post::where('ulid', $ulid)->firstOrFail()->delete();
    }
}

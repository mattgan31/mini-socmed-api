<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function all()
    {
        return Post::all();
    }

    public function findByUlid(string $ulid)
    {
        return Post::where('ulid', $ulid)->firstOrFail();
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

<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;

class CommentRepository
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    public function findByUlid(string $ulid): Comment
    {
        return Comment::where('ulid', $ulid)->firstOrFail();
    }

    public function findByPostUlid(string $ulid)
    {
        $post = Post::where('ulid', $ulid)->firstOrFail();
        return Comment::where('post_id', $post->id)
            ->whereNull('parent_id')
            ->withCount('likes')
            ->latest()
            ->paginate(10);
    }

    public function update(array $data, string $ulid): Comment
    {
        $comment = Comment::where('ulid', $ulid)->firstOrFail();
        $comment->update($data);
        return $comment;
    }

    public function delete(string $ulid)
    {
        return Comment::where('ulid', $ulid)->firstOrFail()->delete();
    }
}

<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function create(array $data): Comment
    {
        return Comment::create($data);
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

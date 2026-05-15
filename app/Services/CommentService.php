<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(
        protected CommentRepository $commentRepository
    ) {}

    public function create(array $data, Post $post)
    {
        return $this->commentRepository->create([
            'post_id' => $post->id,
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);
    }

    public function update(array $data, string $ulid)
    {
        return $this->commentRepository->update($data, $ulid);
    }

    public function delete(string $ulid)
    {
        return $this->commentRepository->delete($ulid);
    }
}

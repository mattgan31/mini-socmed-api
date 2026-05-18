<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(
        protected CommentRepository $commentRepository
    ) {}

    public function create(array $data, Post $post)
    {
        $parent = null;
        $parent_id = $data['parent_id'] ?? null;

        // if (isset($data['parent_id'])) {
        if ($parent_id) {
            $parent = $this->commentRepository->findByUlid($parent_id);

            if ($parent->post_id !== $post->id) {
                throw new Exception('Invalid parent comment');
            }

            if ($parent->deleted_at) {
                throw new Exception('Cannot reply to deleted comment');
            }
        }

        return $this->commentRepository->create([
            'post_id' => $post->id,
            'content' => $data['content'],
            'parent_id' => $parent?->id,
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

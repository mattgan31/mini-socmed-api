<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository,
        protected CommentRepository $commentRepository
    ) {}

    public function create(array $data)
    {
        return $this->postRepository->create([
            'content' => $data['content'],
            'user_id' => Auth::id()
        ]);
    }

    public function getAll()
    {
        return $this->postRepository->all();
    }

    public function findByUlid(string $ulid)
    {
        $post = $this->postRepository->findByUlid($ulid);
        $comments = $this->commentRepository->findByPostUlid($ulid);
        return [
            'post' => $post,
            'comments' => $comments
        ];
    }

    public function update(array $data, string $ulid)
    {
        return $this->postRepository->update($data, $ulid);
    }

    public function delete(string $ulid)
    {
        return $this->postRepository->delete($ulid);
    }
}

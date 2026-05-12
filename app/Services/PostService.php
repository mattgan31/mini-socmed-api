<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository
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
        return $this->postRepository->findByUlid($ulid);
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

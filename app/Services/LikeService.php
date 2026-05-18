<?php

namespace App\Services;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;

class LikeService
{
    public function __construct(
        protected LikeRepository $likeRepository
    ) {}

    public function toggle(Model $model)
    {
        $liked = $this->likeRepository->toggle($model);

        return [
            'liked' => $liked,
            'liked_count' => $model->likes()->count()
        ];
    }
}

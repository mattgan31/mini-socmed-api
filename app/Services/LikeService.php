<?php

namespace App\Services;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function __construct(
        protected LikeRepository $likeRepository
    ) {}

    public function toggle(Model $model)
    {
        $user_id = Auth::id();
        $is_liked = $this->likeRepository->isLiked($model, $user_id);

        $liked = null;
        if ($is_liked) {
            $this->likeRepository->toggleUnlike($is_liked);
            $liked = false;
        } else {
            $this->likeRepository->toggleLike($model, $user_id);
            $liked = true;
        }

        return [
            'liked' => $liked,
            'liked_count' => $model->likes()->count()
        ];
    }
}

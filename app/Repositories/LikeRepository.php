<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeRepository
{
    public function toggleLike(Model $model, int $user_id): void
    {
        $model->likes()->create([
            'user_id' => $user_id
        ]);
    }

    public function toggleUnlike(Like $like): void
    {
        $like->delete();
    }

    public function isLiked(Model $model, int $user_id)
    {
        return $model->likes()->where('user_id', $user_id)->first();
    }
}

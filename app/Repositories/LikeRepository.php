<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeRepository
{
    public function toggleLike(Model $model, int $userId): void
    {
        $model->likes()->create([
            'user_id' => $userId
        ]);
    }

    public function toggleUnlike(Like $like): void
    {
        $like->delete();
    }

    public function isLiked(Model $model, int $userId)
    {
        return $model->likes()->where('user_id', $userId)->first();
    }
}

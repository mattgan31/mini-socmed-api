<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeRepository
{
    public function toggle(Model $model)
    {
        $user_id = Auth::id();
        $like = $model->likes()
            ->where('user_id', $user_id);

        if ($like->exists()) {
            $like->delete();
            return false;
        }

        $model->likes()->create([
            'user_id' => $user_id
        ]);

        return true;
    }
}

<?php

namespace App\Repositories;

use App\Models\User;

class FollowRepository
{
    public function toggleFollow(User $user, User $targetUser)
    {
        $user->followings()->attach($targetUser->id);
    }

    public function toggleUnfollow(User $user, User $targetUser)
    {
        $user->followings()->detach($targetUser->id);
    }

    public function isFollowed(User $user, User $targetUser): bool
    {
        return $user->followings()->whereKey($targetUser->id)->exists();
    }
}

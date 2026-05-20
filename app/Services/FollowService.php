<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\FollowRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FollowService
{
    public function __construct(
        protected FollowRepository $followRepository
    ) {}

    public function toggle(User $targetUser)
    {
        $user = Auth::user();
        $isFollowed = $this->followRepository->isFollowed($user, $targetUser);

        if ($isFollowed) {
            $this->followRepository->toggleUnfollow($user, $targetUser);
        } else {
            $this->followRepository->toggleFollow($user, $targetUser);
        }

        return [
            'followed' => !$isFollowed,
        ];
    }
}

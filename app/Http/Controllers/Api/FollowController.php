<?php

namespace App\Http\Controllers\Api;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FollowService;

class FollowController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected FollowService $followService
    ) {}

    public function toggleFollow(User $targetUser)
    {
        $result = $this->followService->toggle($targetUser);

        return $this->successResponse(
            $result,
        );
    }
}

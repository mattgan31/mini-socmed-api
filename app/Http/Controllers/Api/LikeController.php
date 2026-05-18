<?php

namespace App\Http\Controllers\Api;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Services\LikeService;

class LikeController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected LikeService $likeService
    ) {}

    public function toggleLikePost(Post $post)
    {
        $result = $this->likeService->toggle($post);

        return $this->successResponse(
            $result,
            $result['liked'] ? 'Successfully liked' : 'Successfully unliked'
        );
    }

    public function toggleLikeComment(Comment $comment)
    {
        $result = $this->likeService->toggle($comment);

        return $this->successResponse(
            $result,
            $result['liked'] ? 'Successfully liked' : 'Successfully unliked'
        );
    }
}

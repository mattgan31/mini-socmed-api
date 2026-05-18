<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use App\Trait\ApiResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected PostService $postService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->postService->getAll();

        return $this->successResponse([
            'posts' => PostResource::collection($result),
            'meta' => [
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'total' => $result->total(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $result = $this->postService->create($request->validated());

        // return new PostResource($result);

        return $this->successResponse(
            new PostResource($result)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $result = $this->postService->findByUlid($post->ulid);

        return $this->successResponse([
            'post' => new PostResource($result['post']),
            'comments' => CommentResource::collection($result['comments']),
            'meta' => [
                'current_page' => $result['comments']->currentPage(),
                'last_page' => $result['comments']->lastPage(),
                'total' => $result['comments']->total(),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $result = $this->postService->update($request->validated(), $post->ulid);

        return $this->successResponse(new PostResource($result));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $this->postService->delete($post->ulid);

        return $this->successResponse(
            null,
            'Post deleted'
        );
    }
}

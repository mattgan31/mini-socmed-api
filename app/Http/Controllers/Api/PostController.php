<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->postService->getAll();

        return PostResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $result = $this->postService->create($request->validated());

        return new PostResource($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $result = $this->postService->findByUlid($post->ulid);

        return new PostResource($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('delete', $post);
        $result = $this->postService->update($request->validated(), $post->ulid);

        return new PostResource($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $this->postService->delete($post->ulid);

        return response()->json([
            'message' => 'Post deleted'
        ]);
    }
}

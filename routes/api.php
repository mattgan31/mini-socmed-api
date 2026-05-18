<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('posts.comments', CommentController::class)->only(['store']);
    // Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    Route::apiResource('posts', PostController::class);

    Route::post('/posts/{post}/like', [
        LikeController::class,
        'togglePost'
    ]);

    Route::post('/comments/{comment}/like', [
        LikeController::class,
        'toggleComment'
    ]);
});

<?php

namespace App\Trait;

trait ApiResponse
{
    public function successResponse(
        mixed $data = null,
        string $message = "Success",
        int $status = 200
    ) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function errorResponse(
        string $message = 'Error',
        mixed $errors = null,
        int $status = 400
    ) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}

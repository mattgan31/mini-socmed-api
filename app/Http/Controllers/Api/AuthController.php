<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function login(LoginRequest $request)
    {
        $result = $this->userService->login(
            $request->validated()
        );

        return response()->json(['data' => $result], 200);
    }

    public function register(RegisterRequest $request)
    {

        $result = $this->userService->register(
            $request->validated()
        );

        return response()->json(['data' => $result], 201);
    }

    public function me(Request $request)
    {
        return response()->json(['data' => $request->user()]);
    }
}

<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function register(array $data)
    {
        $existingUser = $this->userRepository->findByEmail($data['email']);

        if ($existingUser) {
            throw ValidationException::withMessages(['email' => 'Email already exists']);
        }

        $user = $this->userRepository->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('auth')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $data)
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user['password'])) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials']
            ]);
        }

        // TODO
        // if (!$user->hasVerifiedEmail()) {
        //     throw ValidationException::withMessages([
        //         'email' => ['Please verified your email']
        //     ]);
        // }

        $token = $user->createToken('auth')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}

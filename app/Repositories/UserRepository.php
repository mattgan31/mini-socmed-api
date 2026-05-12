<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail(string $email)
    {
        return User::firstWhere('email', $email);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }
}

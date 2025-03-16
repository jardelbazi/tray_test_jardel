<?php

namespace App\Services\User;

use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;

interface UserServiceInterface
{
    public function getGoogleAuthUrl(): string;

    public function authenticateWithGoogle(string $code): UserUpdateDTO;

    public function update(UserRequest $userRequest): UserUpdateDTO;

    public function getAll();
}

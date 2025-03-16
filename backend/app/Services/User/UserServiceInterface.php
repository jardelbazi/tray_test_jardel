<?php

namespace App\Services\User;

use App\DTOs\User\UserFilterDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function getGoogleAuthUrl(): string;

    public function create(string $code): UserUpdateDTO;

    public function update(UserRequest $userRequest): UserUpdateDTO;

    public function getAll(?UserFilterDTO $userFilterDTO = null): LengthAwarePaginator;
}

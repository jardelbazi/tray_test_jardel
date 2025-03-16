<?php

namespace App\Adapters\User;

use App\DTOs\GoogleUser\GoogleUserDTO;
use App\DTOs\User\UserDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserAdapterInterface
{
    public function toModel(UserDTO $userDTO): User;

    public function toDTO(GoogleUserDTO $googleUser): UserDTO;

    public function fromModel(User $user): UserUpdateDTO;

    public function fromRequest(UserRequest $request): UserDTO;
}

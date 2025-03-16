<?php

namespace App\Adapters\User;

use App\DTOs\GoogleUser\GoogleUserDTO;
use App\DTOs\User\UserDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserAdapter implements UserAdapterInterface
{
    public function toModel(UserDTO $userDTO, ?User $user = null): User
    {
        $userModel = new User();

        $userModel->name = $userDTO->name;
        $userModel->email = $userDTO->email;
        $userModel->birth_date = $userDTO->birthDate;
        $userModel->cpf = $userDTO->cpf;
        $userModel->email = $userDTO->email ?? $user?->email;
        $userModel->googleId = $userDTO->googleId ?? $user?->google_id;
        $userModel->googleToken = $userDTO->googleToken ?? $user?->google_token;

        return $userModel;
    }

    public function toDTO(GoogleUserDTO $googleUser): UserDTO
    {
        return new UserDTO(
            googleId: $googleUser->googleId,
            name: $googleUser->name,
            email: $googleUser->email,
            googleToken: $googleUser->token,
        );
    }

    public function fromModel(User $user): UserUpdateDTO
    {
        return new UserUpdateDTO(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            birthDate: $user->birth_date,
            cpf: $user->cpf,
            googleId: $user->google_id,
            googleToken: $user->google_token,
        );
    }

    public function fromRequest(UserRequest $request): UserDTO
    {
        return new UserDTO(
            googleId: $request->route('id'),
            name: $request->name,
            email: $request->email,
            birthDate: $request->birth_date,
            cpf: $request->cpf,
        );
    }
}

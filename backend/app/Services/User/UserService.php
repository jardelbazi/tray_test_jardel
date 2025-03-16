<?php

namespace App\Services\User;

use App\Adapters\User\UserAdapterInterface;
use App\DTOs\User\UserUpdateDTO;
use App\Events\UserCreated;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\GoogleAuth\GoogleAuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private GoogleAuthServiceInterface $googleAuthService,
        private UserAdapterInterface $userAdapter,
    ) {}

    public function getGoogleAuthUrl(): string
    {
        return $this->googleAuthService->getAuthUrl();
    }

    public function authenticateWithGoogle(string $code): UserUpdateDTO
    {
        $googleUserDTO = $this->googleAuthService->fetchGoogleUser($code);
        $userDTO = $this->userAdapter->toDTO($googleUserDTO);

        $user = $this->userRepository->getByGoogleId($userDTO->googleId);

        if (blank($user)) {
            $userModel = $this->userAdapter->toModel($userDTO);
            $user = $this->userRepository->create($userModel);

            event(new UserCreated($user));
        }

        Auth::login($user);

        return $this->userAdapter->fromModel($user);
    }

    public function update(UserRequest $userRequest): UserUpdateDTO
    {
        $userUpdateDTO = $this->userAdapter->fromRequest($userRequest);
        $user = $this->userRepository->getByGoogleId($userUpdateDTO->googleId);

        if (blank($user)) {
            throw new \Exception('Usuário não encontrado');
        }

        $userModel = $this->userAdapter->toModel($userUpdateDTO, $user);
        $updatedUser = $this->userRepository->update($user, $userModel->toArray());

        return $this->userAdapter->fromModel($updatedUser);
    }

    public function getAll()
    {
        $users = $this->userRepository->getAll();
        return $users;
    }
}

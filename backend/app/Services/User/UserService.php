<?php

namespace App\Services\User;

use App\Adapters\User\UserAdapterInterface;
use App\DTOs\User\UserFilterDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Events\UserCreated;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserServiceException;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\GoogleAuth\GoogleAuthServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 *
 * Implementação do serviço de gerenciamento de usuários, incluindo criação, atualização,
 * autenticação e listagem de usuários. Este serviço também lida com a autenticação do
 * Google e interage com o repositório de usuários, adaptadores e serviços relacionados.
 *
 * @package App\Services\User
 */
class UserService implements UserServiceInterface
{
    /**
     * Construtor da classe UserService.
     *
     * @param UserRepositoryInterface $userRepository Repositório responsável pelas operações com o banco de dados de usuários.
     * @param GoogleAuthServiceInterface $googleAuthService Serviço responsável pela autenticação via Google.
     * @param UserAdapterInterface $userAdapter Adaptador para conversão entre diferentes representações de usuário (DTO, Model).
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private GoogleAuthServiceInterface $googleAuthService,
        private UserAdapterInterface $userAdapter,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function getGoogleAuthUrl(): string
    {
        return $this->googleAuthService->getAuthUrl();
    }

    /**
     * {@inheritDoc}
     * @throws UserServiceException Caso ocorra um erro durante a criação do usuário.
     */
    public function create(string $code): UserUpdateDTO
    {
        DB::beginTransaction();

        try {
            $googleUserDTO = $this->googleAuthService->fetchGoogleUser($code);
            $userDTO = $this->userAdapter->toDTO($googleUserDTO);

            $user = $this->userRepository->getByGoogleId($userDTO->googleId);

            if (blank($user)) {
                $userModel = $this->userAdapter->toModel($userDTO);
                $user = $this->userRepository->create($userModel);

                event(new UserCreated($user));
            }

            Auth::login($user);

            $userUpdateDTO = $this->userAdapter->fromModel($user);
            DB::commit();

            return $userUpdateDTO;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UserServiceException("Erro ao  criar usuário: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * @throws UserNotFoundException Se o usuário não for encontrado.
     * @throws UserServiceException Se ocorrer algum erro durante a atualização do usuário.
     */
    public function update(UserRequest $userRequest): UserUpdateDTO
    {
        DB::beginTransaction();

        try {
            $userUpdateDTO = $this->userAdapter->fromRequest($userRequest);
            $user = $this->userRepository->getByGoogleId($userUpdateDTO->googleId);

            if (blank($user)) {
                throw new UserNotFoundException('Usuário não encontrado');
            }

            $userModel = $this->userAdapter->toModel($userUpdateDTO, $user);
            $updatedUser = $this->userRepository->update($user, $userModel->toArray());

            $userUpdateDTO = $this->userAdapter->fromModel($updatedUser);

            DB::commit();

            return $userUpdateDTO;
        } catch (UserNotFoundException $e) {
            DB::rollBack();
            throw $e;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UserServiceException("Erro ao atualizar o usuário: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(?UserFilterDTO $userFilterDTO = null): LengthAwarePaginator
    {
        $cacheKey = 'users_all_' . md5(json_encode($userFilterDTO));

        return cache()->remember($cacheKey, 3600, function () use ($userFilterDTO) {
            return $this->userRepository->getAll($userFilterDTO);
        });
    }
}

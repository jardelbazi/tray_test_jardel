<?php

namespace App\Adapters\User;

use App\DTOs\GoogleUser\GoogleUserDTO;
use App\DTOs\User\UserDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;

/**
 * Interface UserAdapterInterface
 *
 * Define o contrato para a adaptação de dados entre o modelo User e os DTOs relacionados
 * (UserDTO, UserUpdateDTO, GoogleUserDTO). Também inclui métodos para converter dados de requisições
 * em DTOs de usuário e para transformar DTOs em modelos e vice-versa.
 *
 * @package App\Adapters\User
 */
interface UserAdapterInterface
{
    /**
     * Converte um UserDTO em um modelo User.
     *
     * @param UserDTO $userDTO O DTO com os dados do usuário.
     * @param User|null $user Instância opcional do modelo User existente para atualização.
     *
     * @return User O modelo User representando os dados do DTO.
     */
    public function toModel(UserDTO $userDTO, ?User $user = null): User;

    /**
     * Converte um GoogleUserDTO em um UserDTO.
     *
     * @param GoogleUserDTO $googleUser O DTO com os dados do usuário do Google.
     *
     * @return UserDTO O DTO representando o usuário adaptado.
     */
    public function toDTO(GoogleUserDTO $googleUser): UserDTO;

    /**
     * Converte um modelo User em um UserUpdateDTO.
     *
     * @param User $user O modelo User a ser convertido.
     *
     * @return UserUpdateDTO O DTO com os dados do usuário para atualização.
     */
    public function fromModel(User $user): UserUpdateDTO;

    /**
     * Converte um UserRequest em um UserDTO.
     *
     * @param UserRequest $request O request contendo os dados do usuário.
     *
     * @return UserDTO O DTO representando os dados do usuário extraídos do request.
     */
    public function fromRequest(UserRequest $request): UserDTO;
}

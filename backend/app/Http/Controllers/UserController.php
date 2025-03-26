<?php

namespace App\Http\Controllers;

use App\Adapters\User\UserFilterAdapterInterface;
use App\Http\Requests\GoogleIdRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    /**
     * @param UserServiceInterface $userService Serviço de usuários.
     * @param UserFilterAdapterInterface $userFilterAdapter Adaptador para conversão de filtros de requisição.
     */
    public function __construct(
        private UserServiceInterface $userService,
        private UserFilterAdapterInterface $userFilterAdapter
    ) {}

    /**
     * Redireciona o usuário para o fluxo de autenticação do Google.
     *
     * @return JsonResponse Retorna a URL de autenticação do Google.
     */
    public function redirectToGoogle()
    {
        return response()->json(['auth_url' => $this->userService->getGoogleAuthUrl()]);
    }

    /**
     * Manipula o callback da autenticação do Google e cria ou autentica o usuário.
     *
     * @param Request $request A requisição contendo o código de autenticação do Google.
     * @return JsonResponse Retorna os dados do usuário autenticado/criado.
     */
    public function handleGoogleCallback(Request $request)
    {
        $user = $this->userService->create($request->get('code'));
        return response()->json(['user' => $user]);
    }

    /**
     * Atualiza os dados de um usuário.
     *
     * @param UserRequest $request Requisição validada contendo os novos dados do usuário.
     * @return JsonResponse Retorna a mensagem de sucesso e os dados do usuário atualizado.
     */
    public function update(UserRequest $request)
    {
        $user = $this->userService->update($request);
        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);
    }

    /**
     * Lista os usuários com base nos filtros passados.
     *
     * @param Request $request Requisição contendo parâmetros de filtro.
     * @return JsonResponse Retorna a lista de usuários filtrados.
     */
    public function index(Request $request)
    {
        $filterDTO = $this->userFilterAdapter->fromRequest($request);

        $users = $this->userService->getAll($filterDTO);

        return response()->json(['users' => $users]);
    }

    /**
     * Obtém um usuário com base no Google ID fornecido na requisição.
     *
     * Este método converte a requisição em um DTO de filtro, consulta o serviço
     * de usuário para recuperar um único usuário correspondente e retorna os
     * dados em formato JSON.
     *
     * @param GoogleIdRequest $request A requisição contendo o Google ID do usuário.
     * @return JsonResponse Retorna os dados do usuário encontrado.
     */
    public function getUser(GoogleIdRequest $request)
    {
        $filterDTO = $this->userFilterAdapter->fromRequest($request);

        $user = $this->userService->getOne($filterDTO);

        return response()->json($user);
    }
}

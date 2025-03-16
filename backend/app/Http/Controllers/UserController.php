<?php

namespace App\Http\Controllers;

use App\Adapters\User\UserFilterAdapterInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService,
        private UserFilterAdapterInterface $userFilterAdapter
    ) {}

    public function redirectToGoogle()
    {
        return response()->json(['auth_url' => $this->userService->getGoogleAuthUrl()]);
    }

    public function handleGoogleCallback(Request $request)
    {
        $user = $this->userService->create($request->get('code'));
        return response()->json(['user' => $user]);
    }

    public function update(UserRequest $request)
    {
        $user = $this->userService->update($request);
        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);
    }

    public function index(Request $request)
    {
        $filterDTO = $this->userFilterAdapter->fromRequest($request);

        $users = $this->userService->getAll($filterDTO);

        return response()->json(['users' => $users]);
    }
}

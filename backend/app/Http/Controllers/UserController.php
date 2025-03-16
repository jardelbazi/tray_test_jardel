<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    public function redirectToGoogle()
    {
        return response()->json(['auth_url' => $this->userService->getGoogleAuthUrl()]);
    }

    public function handleGoogleCallback(Request $request)
    {
        $user = $this->userService->authenticateWithGoogle($request->get('code'));
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

    public function index()
    {
        $users = $this->userService->getAll();
        return response()->json(['users' => $users]);
    }
}

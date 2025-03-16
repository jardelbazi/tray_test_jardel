<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleAuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private GoogleAuthService $googleAuthService;

    public function __construct(GoogleAuthService $googleAuthService)
    {
        $this->googleAuthService = $googleAuthService;
    }

    public function redirectToGoogle()
    {
        return response()->json(['auth_url' => $this->googleAuthService->getAuthUrl()]);
    }

    public function handleGoogleCallback(Request $request)
    {
        if (!$request->has('code')) {
            return response()->json(['error' => 'Authorization code not provided'], 400);
        }

        $user = $this->googleAuthService->handleCallback($request->code);
        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }

    public function getUser()
    {
        return response()->json(Auth::user());
    }
}

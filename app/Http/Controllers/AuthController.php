<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Events\PasswordResetRequested;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());

        if (is_string($user)) {
            return response()->json(['message' => $user], 422);
        }

        return response()->json(['message' => 'Usuário registrado com sucesso']);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $request->user()->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $request->user()]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        event(new PasswordResetRequested($request->input('email')));

        return redirect()->back()->with('status', 'Solicitação de redefinição enviada. Verifique seu e-mail.');
    }
}

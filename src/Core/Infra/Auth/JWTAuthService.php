<?php

namespace Core\Infra\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class JWTAuthService
{
    public function authenticate($credentials): string
    {
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            throw new \Exception('Credenciais inválidas');
        }
        return $token;
    }

    public function refreshToken(): string
    {
        $token = Auth::refresh();
        return $token;
    }

    public function logout(): void
    {
        Auth::logout(true);
    }
}

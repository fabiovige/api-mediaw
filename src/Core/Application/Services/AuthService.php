<?php

namespace Core\Application\Services;

use Core\Application\UseCase\Auth\ObtemTokenApiServiceUseCase;
use Core\Application\UseCase\Auth\ObtemTokenUseCase;
use Core\Domain\Interfaces\AuthServiceInterface;
use Core\Infra\Auth\JWTAuthService;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private ObtemTokenUseCase $obtemTokenUseCase,
        private ObtemTokenApiServiceUseCase $obtemTokenApiService,
        protected JWTAuthService $jwt
    ){}

    public function authenticate($credentials): string
    {
        return 'string';
    }

    public function refreshToken(): string
    {
        return $this->jwt->refreshToken();
    }

    public function logout(): void
    {
        $this->jwt->logout();
    }

    public function getTokenApiService(string $cnpj): string
    {
        return $this->obtemTokenApiService->execute($cnpj);
    }

    public function getToken(string $token_api_service): string
    {
        return $this->obtemTokenUseCase->execute($token_api_service);
    }

}
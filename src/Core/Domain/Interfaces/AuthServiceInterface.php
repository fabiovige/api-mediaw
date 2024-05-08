<?php

namespace Core\Domain\Interfaces;

interface AuthServiceInterface
{
    public function authenticate($credentials): string;
    public function refreshToken(): string;
    public function logout(): void;
    public function getTokenApiService(string $cnpj): string;
    public function getToken(string $token_api_service): string;
}

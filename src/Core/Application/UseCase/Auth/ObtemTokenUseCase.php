<?php

namespace Core\Application\UseCase\Auth;

use Core\Infra\Auth\JWTAuthService;
use Core\Infra\Repositories\CompanyAuthenticationRepository;

class ObtemTokenUseCase
{
    public function __construct(
        protected CompanyAuthenticationRepository $companyAuthenticationRepository,
    ){}

    public function execute(string $token_api_service): string
    {
        $email = $this->companyAuthenticationRepository->getEmail($token_api_service);

        $credentials = [
            'email' => $email,
            'password' => $token_api_service
        ];

        $jwt = new JWTAuthService();
        $token = $jwt->authenticate($credentials);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }
}
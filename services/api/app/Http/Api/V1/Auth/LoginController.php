<?php

namespace App\Http\Api\V1\Auth;

use App\Services\AuthService;
use Domain\Auth\Dto\LoginDto;
use Illuminate\Http\JsonResponse;

class LoginController
{
    /**
     * @param \App\Services\AuthService $service
     * @param \Domain\Auth\Dto\LoginDto $dto
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function __invoke(AuthService $service, LoginDto $dto): JsonResponse
    {
        return new JsonResponse([
            'token' => $service->login($dto),
        ], 201);
    }
}

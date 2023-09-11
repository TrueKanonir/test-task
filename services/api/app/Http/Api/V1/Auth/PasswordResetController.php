<?php

namespace App\Http\Api\V1\Auth;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Domain\Auth\Dto\PasswordResetDto;

class PasswordResetController
{
    /**
     * @param \App\Services\AuthService $service
     * @param \Domain\Auth\Dto\PasswordResetDto $dto
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AuthService $service, PasswordResetDto $dto): JsonResponse
    {
        $service->sendPasswordResetLink($dto);

        return new JsonResponse(status: 204);
    }
}

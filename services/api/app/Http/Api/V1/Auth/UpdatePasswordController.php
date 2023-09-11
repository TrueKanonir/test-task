<?php

namespace App\Http\Api\V1\Auth;

use App\Services\AuthService;
use Domain\Auth\Dto\UpdatePasswordDto;
use Illuminate\Http\JsonResponse;

class UpdatePasswordController
{
    /**
     * @param \App\Services\AuthService $service
     * @param \Domain\Auth\Dto\UpdatePasswordDto $dto
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AuthService $service, UpdatePasswordDto $dto): JsonResponse
    {
        $service->resetPassword($dto);

        return new JsonResponse(status: 204);
    }
}

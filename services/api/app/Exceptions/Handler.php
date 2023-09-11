<?php

namespace App\Exceptions;

use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (\Exception $e) {
            return match(true) {
                $e instanceof AuthenticationException => new JsonResponse([
                    'message' => $e->getMessage(),
                ], 401),
                $e instanceof ValidationException => $this->toValidationResponse(
                    $e->validator->errors()
                ),
                default => [
                    'message' => $e->getMessage(),
                ],
            };
        });
    }

    /**
     * @param \Illuminate\Support\MessageBag $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function toValidationResponse(MessageBag $message): JsonResponse
    {
        return new JsonResponse([
            'errors' => collect($message)
                ->map(fn(array $errors, string $column) => [$column => Arr::first($errors)])
                ->collapse()
                ->all(),
            'message' => 'Validation error',
            'code' => 422,
        ], 422);
    }
}

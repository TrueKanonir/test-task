<?php

namespace App\Services;

use Domain\Auth\Dto\PasswordResetDto;
use Domain\Auth\Dto\UpdatePasswordDto;
use Domain\Shared\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Domain\Auth\Dto\LoginDto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(
        protected Request $request
    ) {}

    /**
     * @param \Domain\Auth\Dto\LoginDto $dto
     * @return string
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function login(LoginDto $dto): string
    {
        /** @var \Domain\Shared\User $user */
        $user = User::query()->where(['email' => $dto->email])->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw new AuthenticationException();
        }

        return $user->createToken($dto->email)->plainTextToken;
    }

    /**
     * @param PasswordResetDto $dto
     * @return void
     */
    public function sendPasswordResetLink(PasswordResetDto $dto)
    {
        Password::sendResetLink(['email' => $dto->email]);
    }

    /**
     * @param \Domain\Auth\Dto\UpdatePasswordDto $dto
     * @return void
     */
    public function resetPassword(UpdatePasswordDto $dto)
    {
        Password::reset(
            $dto->all(),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }

    /**
     * @return \Domain\Shared\User
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function getUserOrFail(): User
    {
        if (! $user = $this->request->user('sanctum')) {
            throw new AuthenticationException();
        }

        return $user;
    }
}

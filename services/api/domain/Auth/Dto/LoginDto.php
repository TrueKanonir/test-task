<?php

namespace Domain\Auth\Dto;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Required;

class LoginDto extends Data
{
    public function __construct(
        #[Required, Email, Min(5), Max(128)]
        public readonly string $email,

        #[Required, Password(min: 6)]
        public readonly string $password
    ) {}
}

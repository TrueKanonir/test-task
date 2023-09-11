<?php

namespace Domain\Auth\Dto;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class PasswordResetDto extends Data
{
    public function __construct(
        #[Required, Email, Min(5)]
        public readonly string $email
    ) {}
}

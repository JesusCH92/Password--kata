<?php

declare(strict_types=1);

namespace App\Password\ApplicationService\DTO;

final class PasswordCheckerResponse
{
    private bool $isValidPassword;

    public function __construct(bool $isValidPassword)
    {
        $this->isValidPassword = $isValidPassword;
    }

    public function isValidPassword(): bool
    {
        return $this->isValidPassword;
    }
}
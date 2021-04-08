<?php

declare(strict_types=1);

namespace App\Password\ApplicationService\DTO;

final class PasswordCheckerRequest
{
    private string $plainPassword;

    public function __construct(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function plainPassword(): string
    {
        return $this->plainPassword;
    }
}
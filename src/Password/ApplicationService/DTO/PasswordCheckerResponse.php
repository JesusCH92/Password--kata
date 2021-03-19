<?php

declare(strict_types=1);

namespace App\Password\ApplicationService\DTO;

final class PasswordCheckerResponse
{
    private array $passwordCollection;

    public function __construct(array $passwordCollection)
    {
        $this->passwordCollection = $passwordCollection;
    }

    public function passwordCollection(): array
    {
        return $this->passwordCollection;
    }
}
<?php

declare(strict_types=1);

namespace App\Password\ApplicationService\DTO;

final class PasswordCheckerRequest
{
    private array $plainPasswordCollection;

    public function __construct(array $plainPasswordCollection)
    {
        $this->plainPasswordCollection = $plainPasswordCollection;
    }

    public function plainPasswordCollection(): array
    {
        return $this->plainPasswordCollection;
    }
}
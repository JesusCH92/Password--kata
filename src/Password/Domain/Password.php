<?php

declare(strict_types=1);

namespace App\Password\Domain;

final class Password
{
    private int $firstNumberValidator;
    private int $lastNumberValidator;
    private string $characterValidator;
    private string $password;

    public function __construct(
        int $firstNumberValidator,
        int $lastNumberValidator,
        string $characterValidator,
        string $password
    ) {
        $this->firstNumberValidator = $firstNumberValidator;
        $this->lastNumberValidator  = $lastNumberValidator;
        $this->characterValidator   = $characterValidator;
        $this->password             = $password;
    }

    public function firstNumberValidator(): int
    {
        return $this->firstNumberValidator;
    }

    public function lastNumberValidator(): int
    {
        return $this->lastNumberValidator;
    }

    public function characterValidator(): string
    {
        return $this->characterValidator;
    }

    public function password(): string
    {
        return $this->password;
    }
}
<?php

declare(strict_types=1);

namespace Test\Spy;

use App\Password\Domain\Password;
use App\Password\Domain\PasswordValidatorRepository;

final class PasswordValidatorRepositorySpy implements PasswordValidatorRepository
{
    private $validateWasCalled = false;

    public function isValidPassword(Password $password): bool
    {
        $this->validateWasCalled = true;

        return false;
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}
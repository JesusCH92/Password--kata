<?php

declare(strict_types=1);

namespace App\Password\Infrastructure;

use App\Password\Domain\Password;
use App\Password\Domain\PasswordValidatorRepository;

final class OldJobPasswordValidatorRepository implements PasswordValidatorRepository
{
    public function isValidPassword(Password $password): bool
    {
        return $password->firstNumberValidator() <= substr_count($password->password(), $password->characterValidator()) && substr_count($password->password(), $password->characterValidator()) <= $password->lastNumberValidator();
    }
}

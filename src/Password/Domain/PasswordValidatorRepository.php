<?php

declare(strict_types=1);

namespace App\Password\Domain;

interface PasswordValidatorRepository
{
    public function isValidPassword(Password $password): bool;
}
<?php

declare(strict_types=1);

namespace App\Password\Infrastructure;

use App\Password\Domain\Password;
use App\Password\Domain\PasswordValidatorRepository;

final class NewJobPasswordValidatorRepository implements PasswordValidatorRepository
{
    public function isValidPassword(Password $password): bool
    {
        $isFirstNumberValidatorSameCharacterValidator = $password->password()[$password->firstNumberValidator()-1] === $password->characterValidator();
        $isLastNumberValidatorSameCharacterValidator = $password->password()[$password->lastNumberValidator()-1] === $password->characterValidator();

        return ($isFirstNumberValidatorSameCharacterValidator && !$isLastNumberValidatorSameCharacterValidator) ||
        (!$isFirstNumberValidatorSameCharacterValidator && $isLastNumberValidatorSameCharacterValidator);
    }
}
<?php

declare(strict_types=1);

namespace App\Password\Infrastructure;

use App\Password\ApplicationService\DTO\PasswordCheckerRequest;
use App\Password\ApplicationService\PasswordChecker;

final class PasswordCheckerCommand
{
    private PasswordChecker $passwordChecker;

    public function __construct(PasswordChecker $passwordChecker)
    {
        $this->passwordChecker = $passwordChecker;
    }

    public function __invoke()
    {
        $passwordCollection = file("input.txt", FILE_IGNORE_NEW_LINES);
        $validPlainPasswordAmount = 0;

        foreach ($passwordCollection as $plainPassword) {
            $service = ($this->passwordChecker)(new PasswordCheckerRequest($plainPassword));
            $validPlainPasswordAmount = $service->isValidPassword() ? $validPlainPasswordAmount + 1 : $validPlainPasswordAmount;
        }

        echo "There are $validPlainPasswordAmount valid passwords" . PHP_EOL;
    }
}
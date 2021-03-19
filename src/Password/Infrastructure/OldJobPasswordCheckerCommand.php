<?php

declare(strict_types=1);

namespace App\Password\Infrastructure;

use App\Password\ApplicationService\PasswordChecker;

final class OldJobPasswordCheckerCommand
{
    private PasswordChecker $passwordChecker;

    public function __construct(PasswordChecker $passwordChecker)
    {
        $this->passwordChecker = $passwordChecker;
    }

    public function __invoke()
    {
        $input = file("input.txt", FILE_IGNORE_NEW_LINES);;

        $service = ($this->passwordChecker)($input);
        $validPasswordAmount = count($service);

        echo "There are $validPasswordAmount valid passwords" . PHP_EOL;
    }
}
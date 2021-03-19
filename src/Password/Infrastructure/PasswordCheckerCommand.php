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
        $input = file("input.txt", FILE_IGNORE_NEW_LINES);

        $service = ($this->passwordChecker)(new PasswordCheckerRequest($input));

        $validPasswordAmount = count($service->passwordCollection());

        echo "There are $validPasswordAmount valid passwords" . PHP_EOL;
    }
}
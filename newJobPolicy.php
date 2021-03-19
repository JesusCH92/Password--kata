<?php

use App\Password\ApplicationService\PasswordChecker;
use App\Password\Infrastructure\NewJobPasswordValidatorRepository;
use App\Password\Infrastructure\PasswordCheckerCommand;

require 'vendor/autoload.php';


$passwordCheckerController = new PasswordCheckerCommand(
    new PasswordChecker(
        new NewJobPasswordValidatorRepository()
    )
);

$passwordCheckerController();
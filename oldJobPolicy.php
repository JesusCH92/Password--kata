<?php

use App\Password\ApplicationService\PasswordChecker;
use App\Password\Infrastructure\PasswordCheckerCommand;
use App\Password\Infrastructure\OldJobPasswordValidatorRepository;

require 'vendor/autoload.php';


$passwordCheckerController = new PasswordCheckerCommand(new PasswordChecker(
    new OldJobPasswordValidatorRepository()
));

$passwordCheckerController();
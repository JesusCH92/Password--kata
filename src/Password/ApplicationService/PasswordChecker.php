<?php

declare(strict_types=1);

namespace App\Password\ApplicationService;

use App\Password\ApplicationService\DTO\PasswordCheckerRequest;
use App\Password\ApplicationService\DTO\PasswordCheckerResponse;
use App\Password\Domain\Password;
use App\Password\Domain\PasswordValidatorRepository;

final class PasswordChecker
{
    private PasswordValidatorRepository $passwordValidatorRepository;

    public function __construct(PasswordValidatorRepository $passwordValidatorRepository)
    {
        $this->passwordValidatorRepository = $passwordValidatorRepository;
    }

    public function __invoke(PasswordCheckerRequest $request): PasswordCheckerResponse
    {
        $plainPassword = $request->plainPassword();

        $password = new Password(
            $this->passwordFormat($plainPassword)['firstNumber'],
            $this->passwordFormat($plainPassword)['lastNumber'],
            $this->passwordFormat($plainPassword)['character'],
            $this->passwordFormat($plainPassword)['password'],
        );

        return new PasswordCheckerResponse(
            ($this->passwordValidatorRepository)->isValidPassword($password)
        );
    }

    private function passwordFormat(string $plainPassword): array
    {
        $plainPasswordSlice        = explode(" ", $plainPassword);
        $numberPlainPasswordFormat = $this->numberPasswordFormat($plainPasswordSlice[0]);

        return [
            'firstNumber' => (int)$numberPlainPasswordFormat['firstNumber'],
            'lastNumber' => (int)$numberPlainPasswordFormat['lastNumber'],
            'character' => $this->characterPasswordFormat($plainPasswordSlice[1]),
            'password' => $plainPasswordSlice[2]
        ];
    }

    private function numberPasswordFormat(string $plainNumber): array
    {
        $plainNumberSlice = explode("-", $plainNumber);
        return [
            'firstNumber' => $plainNumberSlice[0],
            'lastNumber' => $plainNumberSlice[1]
        ];
    }

    private function characterPasswordFormat(string $plainCharacter): string
    {
        return str_replace(":", "", $plainCharacter);
    }
}
<?php

declare(strict_types=1);

namespace App\Password\ApplicationService;

final class PasswordChecker
{
    public function __invoke(array $plainPasswordCollection): array
    {
        $passwordValidCollection = [];

        foreach ($plainPasswordCollection as $plainPassword) {
            $passwordValidCollection[] = $this->passwordFormat($plainPassword);
        }

        return $passwordValidCollection;
    }

    private function passwordFormat(string $plainPassword): array
    {
        $plainPasswordSlice = explode(" ", $plainPassword);
        $numberPlainPasswordFormat = $this->numberPasswordFormat($plainPasswordSlice[0]);

        return [
            'firstNumber' => (int)$numberPlainPasswordFormat['firstNumber'],
            'lastNumber'  => (int)$numberPlainPasswordFormat['lastNumber'],
            'character'   => $this->characterPasswordFormat($plainPasswordSlice[1]),
            'password'    => $plainPasswordSlice[2]
        ];
    }

    private function numberPasswordFormat(string $plainNumber): array
    {
        $plainNumberSlice = explode("-", $plainNumber);
        return [
            'firstNumber' => $plainNumberSlice[0],
            'lastNumber'  => $plainNumberSlice[1]
        ];
    }

    private function characterPasswordFormat(string $plainCharacter): string
    {
        return str_replace(":","",$plainCharacter);
    }
}
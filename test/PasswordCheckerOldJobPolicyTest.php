<?php

declare(strict_types=1);

namespace Test;

use App\Password\ApplicationService\DTO\PasswordCheckerRequest;
use App\Password\ApplicationService\DTO\PasswordCheckerResponse;
use App\Password\ApplicationService\PasswordChecker;
use App\Password\Domain\Password;
use App\Password\Infrastructure\OldJobPasswordValidatorRepository;
use PHPUnit\Framework\TestCase;
use Test\Spy\PasswordValidatorRepositorySpy;

class PasswordCheckerOldJobPolicyTest extends TestCase
{
    /**
     * @test
     */
    public function validPasswordForABetween1And3InAbcde()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals(
            $service(new PasswordCheckerRequest('1-3 a: abcde')),
            new PasswordCheckerResponse(true)
        );
    }

    /**
     * @test
     */
    public function invalidPasswordForBBetween1And3InCdefg()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertNotEquals(
            $service(new PasswordCheckerRequest('1-3 b: cdefg')),
            new PasswordCheckerResponse(true)
        );
    }

    /**
     * @test
     */
    public function validPasswordForCBetween2And9InCcccccccc()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals(
            $service(new PasswordCheckerRequest('2-9 c: ccccccccc')),
            new PasswordCheckerResponse(true)
        );
    }

    /**
     * @test
     */
    public function thereMustBe2ValidPasswords()
    {
        $service                  = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $validPlainPasswordAmount = 0;

        foreach (['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc'] as $plainPassword) {
            $response = $service(
                new PasswordCheckerRequest($plainPassword)
            );
            $validPlainPasswordAmount = $response->isValidPassword() ? $validPlainPasswordAmount + 1 : $validPlainPasswordAmount;
        }

        $this->assertEquals(2, $validPlainPasswordAmount);
    }

    /**
     * @test
     */
    public function shouldValidateThePassword()
    {
        $passwordValidatorRepositorySpy = new PasswordValidatorRepositorySpy();

        $service = new PasswordChecker($passwordValidatorRepositorySpy);
        $service(new PasswordCheckerRequest('1-3 a: abcde'));

        $this->assertTrue($passwordValidatorRepositorySpy->verify());
    }

    /**
     * @test
     */
    public function notShouldValidateThePassword()
    {
        $passwordValidatorRepositorySpy = new PasswordValidatorRepositorySpy();

        $service = new PasswordChecker($passwordValidatorRepositorySpy);
        $service(new PasswordCheckerRequest('1-3 a: bbbbbb'));

        $this->assertTrue($passwordValidatorRepositorySpy->verify());
    }
}
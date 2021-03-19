<?php

declare(strict_types=1);

namespace Test;

use App\Password\ApplicationService\DTO\PasswordCheckerRequest;
use App\Password\ApplicationService\DTO\PasswordCheckerResponse;
use App\Password\ApplicationService\PasswordChecker;
use App\Password\Domain\Password;
use App\Password\Infrastructure\NewJobPasswordValidatorRepository;
use PHPUnit\Framework\TestCase;
use Test\Spy\PasswordValidatorRepositorySpy;

class PasswordCheckerNewJobPolicyTest extends TestCase
{
    /**
     * @test
     */
    public function validPasswordForAPosition1And3InAbcde()
    {
        $service = new PasswordChecker(new NewJobPasswordValidatorRepository());
        $this->assertEquals(
            $service(new PasswordCheckerRequest(['1-3 a: abcde'])),
            new PasswordCheckerResponse([new Password(1, 3, 'a', 'abcde')])
        );
    }

    /**
     * @test
     */
    public function validPasswordForAPosition1And3InCbade()
    {
        $service = new PasswordChecker(new NewJobPasswordValidatorRepository());
        $this->assertEquals(
            $service(new PasswordCheckerRequest(['1-3 a: cbade'])),
            new PasswordCheckerResponse([new Password(1, 3, 'a', 'cbade')])
        );
    }

    /**
     * @test
     */
    public function invalidPasswordForBPosition1And3InCdefg()
    {
        $service = new PasswordChecker(new NewJobPasswordValidatorRepository());
        $this->assertNotEquals(
            $service(new PasswordCheckerRequest(['1-3 b: cdefg'])),
            new PasswordCheckerResponse([new Password(1, 3, 'b', 'cdefg')])
        );
    }

    /**
     * @test
     */
    public function invalidPasswordForCPosition2And9InCcccccccc()
    {
        $service = new PasswordChecker(new NewJobPasswordValidatorRepository());
        $this->assertNotEquals(
            $service(new PasswordCheckerRequest(['2-9 c: ccccccccc'])),
            new PasswordCheckerResponse([new Password(2, 9, 'c', 'ccccccccc')])
        );
    }

    /**
     * @test
     */
    public function thereMustBe1ValidPassword()
    {
        $service = new PasswordChecker(new NewJobPasswordValidatorRepository());

        $response = $service(
            new PasswordCheckerRequest(['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc'])
        );

        $validPasswordAmount = count($response->passwordCollection());

        $this->assertEquals(1, $validPasswordAmount);
    }

    /**
     * @test
     */
    public function shouldValidateThePassword()
    {
        $passwordValidatorRepositorySpy = new PasswordValidatorRepositorySpy();

        $service = new PasswordChecker($passwordValidatorRepositorySpy);
        $service(new PasswordCheckerRequest(['1-3 a: abcde']));

        $this->assertTrue($passwordValidatorRepositorySpy->verify());
    }
}
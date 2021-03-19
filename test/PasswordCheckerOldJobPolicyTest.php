<?php

declare(strict_types=1);

namespace Test;

use App\Password\ApplicationService\DTO\PasswordCheckerRequest;
use App\Password\ApplicationService\DTO\PasswordCheckerResponse;
use App\Password\ApplicationService\PasswordChecker;
use App\Password\Domain\Password;
use App\Password\Infrastructure\OldJobPasswordValidatorRepository;
use Test\Spy\OldJobPasswordValidatorRepositorySpy;
use PHPUnit\Framework\TestCase;

class PasswordCheckerOldJobPolicyTest extends TestCase
{
    /**
     * @test
     */
    public function validPasswordForABetween1And3InAbcde()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals($service(new PasswordCheckerRequest(['1-3 a: abcde'])), new PasswordCheckerResponse([new Password(1, 3, 'a', 'abcde')]));
    }

    /**
     * @test
     */
    public function invalidPasswordForBBetween1And3InCdefg()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertNotEquals($service(new PasswordCheckerRequest(['1-3 b: cdefg'])), new PasswordCheckerResponse([new Password(1, 3, 'b', 'cdefg')]));
    }

    /**
     * @test
     */
    public function validPasswordForCBetween2And9InCcccccccc()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals($service(new PasswordCheckerRequest(['2-9 c: ccccccccc'])), new PasswordCheckerResponse([new Password(2, 9, 'c', 'ccccccccc')]));
    }

    /**
     * @test
     */
    public function thereMustBe2ValidPasswords()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $response = $service(new PasswordCheckerRequest(['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc']));
        $validPasswordAmount = count($response->passwordCollection());

        $this->assertEquals(2, $validPasswordAmount);
    }

    /**
     * @test
     */
    public function shouldValidateThePassword()
    {
        $oldJobPasswordValidatorRepositorySpy = new OldJobPasswordValidatorRepositorySpy();

        $service = new PasswordChecker($oldJobPasswordValidatorRepositorySpy);
        $service(new PasswordCheckerRequest(['1-3 a: abcde']));

        $this->assertTrue($oldJobPasswordValidatorRepositorySpy->verify());
    }

    /**
     * @test
     */
    public function notShouldValidateThePassword()
    {
        $oldJobPasswordValidatorRepositorySpy = new OldJobPasswordValidatorRepositorySpy();

        $service = new PasswordChecker($oldJobPasswordValidatorRepositorySpy);
        $service(new PasswordCheckerRequest(['1-3 a: bbbbbb']));

        $this->assertTrue($oldJobPasswordValidatorRepositorySpy->verify());
    }
}
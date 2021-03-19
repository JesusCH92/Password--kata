<?php

declare(strict_types=1);

namespace Test;

use App\Password\ApplicationService\PasswordChecker;
use App\Password\Domain\Password;
use App\Password\Infrastructure\OldJobPasswordValidatorRepository;
use PHPUnit\Framework\TestCase;

class PasswordCheckerTest extends TestCase
{
    /**
     * @test
     */
    public function validPasswordForABetween1And3InAbcde()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals($service(['1-3 a: abcde']), [new Password(1, 3, 'a', 'abcde')]);
    }

    /**
     * @test
     */
    public function invalidPasswordForBBetween1And3InCdefg()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertNotEquals($service(['1-3 b: cdefg']), [new Password(1, 3, 'b', 'cdefg')]);
    }

    /**
     * @test
     */
    public function validPasswordForCBetween2And9InCcccccccc()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $this->assertEquals($service(['2-9 c: ccccccccc']), [new Password(2, 9, 'c', 'ccccccccc')]);
    }

    /**
     * @test
     */
    public function thereMustBe2ValidPasswords()
    {
        $service = new PasswordChecker(new OldJobPasswordValidatorRepository());
        $validPasswordAmount = count($service(['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc']));

        $this->assertEquals(2, $validPasswordAmount);
    }
}
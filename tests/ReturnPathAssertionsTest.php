<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class ReturnPathAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailReturnPath
    |--------------------------------------------------------------------------
    */

    public function testMailReturnPathSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->returnPath($email);

        $this->assertMailReturnPath($email, $mail);
    }

    public function testMailReturnPathSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($email)
        );

        $this->assertMailReturnPath($email, $mail);
    }

    public function testMailReturnPathThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->returnPath($this->faker->unique()->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected return path was not [{$email}].");

        $this->assertMailReturnPath($email, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotReturnPath
    |--------------------------------------------------------------------------
    */

    public function testMailNotReturnPathSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->returnPath($this->faker->unique()->email);

        $this->assertMailNotReturnPath($email, $mail);
    }

    public function testMailNotReturnPathSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($this->faker->unique()->email)
        );

        $this->assertMailNotReturnPath($email, $mail);
    }

    public function testMailNotReturnPathThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Email())->returnPath($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected return path was [{$email}].");

        $this->assertMailNotReturnPath($email, $mail);
    }
}

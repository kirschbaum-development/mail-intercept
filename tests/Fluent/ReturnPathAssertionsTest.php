<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class ReturnPathAssertionsTest extends TestCase
{
    public function testMailReturnPathSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($email)
        );

        $mail->assertReturnPath($email);
    }

    public function testMailReturnPathThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected return path was not [{$email}].");

        $mail->assertReturnPath($email);
    }

    public function testMailNotReturnPathSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($this->faker->unique()->email)
        );

        $mail->assertNotReturnPath($email);
    }

    public function testMailNotReturnPathThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->returnPath($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected return path was [{$email}].");

        $mail->assertNotReturnPath($email);
    }
}

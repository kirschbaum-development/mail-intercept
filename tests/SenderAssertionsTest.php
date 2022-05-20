<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class SenderAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailSender
    |--------------------------------------------------------------------------
    */

    public function testMailSenderSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->sender($email);

        $this->assertMailSender($email, $mail);
    }

    public function testMailSenderSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->sender($email)
        );

        $this->assertMailSender($email, $mail);
    }

    public function testMailSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->sender($this->faker->unique()->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was not from the expected address [{$email}].");

        $this->assertMailSender($email, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotSender
    |--------------------------------------------------------------------------
    */

    public function testMailNotSenderSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->sender($this->faker->unique()->email);

        $this->assertMailNotSender($email, $mail);
    }

    public function testMailNotSenderSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->sender($this->faker->unique()->email)
        );

        $this->assertMailNotSender($email, $mail);
    }

    public function testMailNotSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Email())->sender($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was from the expected address [{$email}].");

        $this->assertMailNotSender($email, $mail);
    }
}

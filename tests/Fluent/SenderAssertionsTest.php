<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class SenderAssertionsTest extends TestCase
{
    public function testMailSenderSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->sender($email)
        );

        $mail->assertSender($email);
    }

    public function testMailSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->sender($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was not from the expected address [{$email}].");

        $mail->assertSender($email);
    }

    public function testMailNotSenderSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->sender($this->faker->unique()->email)
        );

        $mail->assertNotSender($email);
    }

    public function testMailNotSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->sender($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was from the expected address [{$email}].");

        $mail->assertNotSender($email);
    }
}

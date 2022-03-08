<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class FromAssertionsTest extends TestCase
{
    public function testMailSentFromSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->from($email)
        );

        $mail->assertSentFrom($email);
    }

    public function testMailSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->from($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent from the expected address [{$email}].");

        $mail->assertSentFrom($email);
    }

    public function testMailSentFromMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->from(...$emails)
        );

        $mail->assertSentFrom($emails);
    }

    public function testMailNotSentFromSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->from($this->faker->unique()->email)
        );

        $mail->assertNotSentFrom($email);
    }

    public function testMailNotSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->from($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent from the expected address [{$email}].");

        $mail->assertNotSentFrom($email);
    }

    public function testMailNotSentFromMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->from(
                $this->faker->unique()->email,
                $this->faker->unique()->email
            )
        );

        $mail->assertNotSentFrom($emails);
    }
}

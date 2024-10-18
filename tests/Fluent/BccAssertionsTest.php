<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class BccAssertionsTest extends TestCase
{
    public function testMailBccSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($email)
        );

        $mail->assertBcc($email);
    }

    public function testMailBccThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not BCC'd to the expected address [{$email}].");

        $mail->assertBcc($email);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->bcc(...$emails)
        );

        $mail->assertBcc($emails);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($this->faker->unique()->email)
        );

        $mail->assertNotBcc($email);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was BCC'd to the expected address [{$email}].");

        $mail->assertNotBcc($email);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->bcc(
                $this->faker->unique()->email,
                $this->faker->unique()->email
            )
        );

        $mail->assertNotBcc($emails);
    }
}

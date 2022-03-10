<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class ToAssertionsTest extends TestCase
{
    public function testMailSentToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->to($email)
        );

        $mail->assertSentTo($email);
    }

    public function testMailSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->to($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent to the expected address [{$email}].");

        $mail->assertSentTo($email);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->to(...$emails)
        );

        $mail->assertSentTo($emails);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->to($this->faker->unique()->email)
        );

        $mail->assertNotSentTo($email);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->to($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent to the expected address [{$email}].");

        $mail->assertNotSentTo($email);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->to(
                $this->faker->unique()->email,
                $this->faker->unique()->email
            )
        );

        $mail->assertNotSentTo($emails);
    }
}

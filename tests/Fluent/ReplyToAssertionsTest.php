<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class ReplyToAssertionsTest extends TestCase
{
    public function testMailRepliesToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->replyTo($email)
        );

        $mail->assertRepliesTo($email);
    }

    public function testMailRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->replyTo($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail does not reply to the expected address [{$email}].");

        $mail->assertRepliesTo($email);
    }

    public function testMailRepliesToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->replyTo(...$emails)
        );

        $mail->assertRepliesTo($emails);
    }

    public function testMailNotRepliesToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->replyTo($this->faker->unique()->email)
        );

        $mail->assertNotRepliesTo($email);
    }

    public function testMailNotRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->replyTo($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail replied to the expected address [{$email}].");

        $mail->assertNotRepliesTo($email);
    }

    public function testMailNotRepliesToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->replyTo(
                $this->faker->unique()->email,
                $this->faker->unique()->email
            )
        );

        $mail->assertNotRepliesTo($emails);
    }
}

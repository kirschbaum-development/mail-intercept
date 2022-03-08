<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;

class ReplyToAssertionsTest extends TestCase
{
    public function testMailRepliesToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->replyTo($email);

        $this->assertMailRepliesTo($email, $mail);
    }

    public function testMailRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->replyTo($this->faker->unique()->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail does not reply to the expected address [{$email}].");

        $this->assertMailRepliesTo($email, $mail);
    }

    public function testMailRepliesToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Email())->replyTo(...$emails);

        $this->assertMailRepliesTo($emails, $mail);
    }

    public function testMailNotRepliesToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->replyTo($this->faker->unique()->email);

        $this->assertMailNotRepliesTo($email, $mail);
    }

    public function testMailNotRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Email())->replyTo($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail replied to the expected address [{$email}].");

        $this->assertMailNotRepliesTo($email, $mail);
    }

    public function testMailNotRepliesToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Email())->replyTo(
            $this->faker->unique()->email,
            $this->faker->unique()->email
        );

        $this->assertMailNotRepliesTo($emails, $mail);
    }
}

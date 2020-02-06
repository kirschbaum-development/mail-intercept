<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\ReplyToAssertions;

class ReplyToAssertionsTest extends TestCase
{
    use WithFaker;
    use ReplyToAssertions;

    public function testMailRepliesToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setReplyTo($email);

        $this->assertMailRepliesTo($email, $mail);
    }

    public function testMailRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setReplyTo($this->faker->unique->email);

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

        $mail = (new Swift_Message())->setReplyTo($emails);

        $this->assertMailRepliesTo($emails, $mail);
    }

    public function testMailNotRepliesToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setReplyTo($this->faker->unique()->email);

        $this->assertMailNotRepliesTo($email, $mail);
    }

    public function testMailNotRepliesToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setReplyTo($email);

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

        $mail = (new Swift_Message())->setReplyTo([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotRepliesTo($emails, $mail);
    }
}

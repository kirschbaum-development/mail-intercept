<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\SenderAssertions;

class SenderAssertionsTest extends TestCase
{
    use WithFaker;
    use SenderAssertions;

    public function testMailSenderSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setSender($email);

        $this->assertMailSender($email, $mail);
    }

    public function testMailSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setSender($this->faker->unique->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was not from the expected address [{$email}].");

        $this->assertMailSender($email, $mail);
    }

    public function testMailSenderMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Swift_Message())->setSender($emails);

        $this->assertMailSender($emails, $mail);
    }

    public function testMailNotSenderSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setSender($this->faker->unique()->email);

        $this->assertMailNotSender($email, $mail);
    }

    public function testMailNotSenderThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setSender($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was from the expected address [{$email}].");

        $this->assertMailNotSender($email, $mail);
    }

    public function testMailNotSenderMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Swift_Message())->setSender([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotSender($emails, $mail);
    }
}

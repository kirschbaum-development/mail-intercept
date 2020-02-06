<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\ToAssertions;

class ToAssertionsTest extends TestCase
{
    use WithFaker;
    use ToAssertions;

    public function testMailSentToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setTo($email);

        $this->assertMailSentTo($email, $mail);
    }

    public function testMailSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setTo($this->faker->unique->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent to the expected address [{$email}].");

        $this->assertMailSentTo($email, $mail);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Swift_Message())->setTo($emails);

        $this->assertMailSentTo($emails, $mail);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setTo($this->faker->unique()->email);

        $this->assertMailNotSentTo($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setTo($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent to the expected address [{$email}].");

        $this->assertMailNotSentTo($email, $mail);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Swift_Message())->setTo([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotSentTo($emails, $mail);
    }
}

<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\BccAssertions;

class BccAssertionsTest extends TestCase
{
    use WithFaker;
    use BccAssertions;

    public function testMailBccSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setBcc($email);

        $this->assertMailBcc($email, $mail);
    }

    public function testMailBccThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setBcc($this->faker->unique->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not BCC'd to the expected address [{$email}].");

        $this->assertMailBcc($email, $mail);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Swift_Message())->setBcc($emails);

        $this->assertMailBcc($emails, $mail);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setBcc($this->faker->unique()->email);

        $this->assertMailNotBcc($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setBcc($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was BCC'd to the expected address [{$email}].");

        $this->assertMailNotBcc($email, $mail);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Swift_Message())->setBcc([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotBcc($emails, $mail);
    }
}

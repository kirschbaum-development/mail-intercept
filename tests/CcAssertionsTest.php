<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\CcAssertions;

class CcAssertionsTest extends TestCase
{
    use WithFaker;
    use CcAssertions;

    public function testMailCcSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setCc($email);

        $this->assertMailCc($email, $mail);
    }

    public function testMailCcThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setCc($this->faker->unique->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not CC'd to the expected address [{$email}].");

        $this->assertMailCc($email, $mail);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Swift_Message())->setCc($emails);

        $this->assertMailCc($emails, $mail);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setCc($this->faker->unique()->email);

        $this->assertMailNotCc($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setCc($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was CC'd to the expected address [{$email}].");

        $this->assertMailNotCc($email, $mail);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Swift_Message())->setCc([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotCc($emails, $mail);
    }
}

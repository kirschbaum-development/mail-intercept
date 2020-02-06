<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\FromAssertions;

class FromAssertionsTest extends TestCase
{
    use WithFaker;
    use FromAssertions;

    public function testMailSentFromSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setFrom($email);

        $this->assertMailSentFrom($email, $mail);
    }

    public function testMailSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setFrom($this->faker->unique->email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent from the expected address [{$email}].");

        $this->assertMailSentFrom($email, $mail);
    }

    public function testMailSentFromMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = (new Swift_Message())->setFrom($emails);

        $this->assertMailSentFrom($emails, $mail);
    }

    public function testMailNotSentFromSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Swift_Message())->setFrom($this->faker->unique()->email);

        $this->assertMailNotSentFrom($email, $mail);
    }

    public function testMailNotSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Swift_Message())->setFrom($email);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent from the expected address [{$email}].");

        $this->assertMailNotSentFrom($email, $mail);
    }

    public function testMailNotSentFromMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = (new Swift_Message())->setFrom([
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ]);

        $this->assertMailNotSentFrom($emails, $mail);
    }
}

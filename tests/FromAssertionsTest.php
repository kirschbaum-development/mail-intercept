<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;

class FromAssertionsTest extends TestCase
{
    public function testMailSentFromSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->from($email);

        $this->assertMailSentFrom($email, $mail);
    }

    public function testMailSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->from($this->faker->unique()->email);

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

        $mail = (new Email())->from(...$emails);

        $this->assertMailSentFrom($emails, $mail);
    }

    public function testMailNotSentFromSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->from($this->faker->unique()->email);

        $this->assertMailNotSentFrom($email, $mail);
    }

    public function testMailNotSentFromThrowsProperExpectationFailedException()
    {
        $email = $this->faker->email;

        $mail = (new Email())->from($email);

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

        $mail = (new Email())->from(
            $this->faker->unique()->email,
            $this->faker->unique()->email
        );

        $this->assertMailNotSentFrom($emails, $mail);
    }
}

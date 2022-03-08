<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;

class ToAssertionsTest extends TestCase
{
    public function testMailSentToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->to($email);

        $this->assertMailSentTo($email, $mail);
    }

    public function testMailSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->to($this->faker->unique()->email);

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

        $mail = (new Email())->to(...$emails);

        $this->assertMailSentTo($emails, $mail);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->to($this->faker->unique()->email);

        $this->assertMailNotSentTo($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->to($email);

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

        $mail = (new Email())->to(
            $this->faker->unique()->email,
            $this->faker->unique()->email
        );

        $this->assertMailNotSentTo($emails, $mail);
    }
}

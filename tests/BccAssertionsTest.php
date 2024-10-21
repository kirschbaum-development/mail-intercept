<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class BccAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailBcc
    |--------------------------------------------------------------------------
    */

    public function testMailBccSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->bcc($email);

        $this->assertMailBcc($email, $mail);
    }

    public function testMailBccSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($email)
        );

        $this->assertMailBcc($email, $mail);
    }

    public function testMailBccThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->bcc($this->faker->unique()->email);

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

        $mail = (new Email())->bcc(...$emails);

        $this->assertMailBcc($emails, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotBcc
    |--------------------------------------------------------------------------
    */

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->bcc($this->faker->unique()->email);

        $this->assertMailNotBcc($email, $mail);
    }

    public function testMailNotSentToSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->bcc($this->faker->unique()->email)
        );

        $this->assertMailNotBcc($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->bcc($email);

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

        $mail = (new Email())->bcc(
            $this->faker->unique()->email,
            $this->faker->unique()->email
        );

        $this->assertMailNotBcc($emails, $mail);
    }
}

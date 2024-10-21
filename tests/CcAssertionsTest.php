<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class CcAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailCc
    |--------------------------------------------------------------------------
    */

    public function testMailCcSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->cc($email);

        $this->assertMailCc($email, $mail);
    }

    public function testMailCcSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->cc($email)
        );

        $this->assertMailCc($email, $mail);
    }

    public function testMailCcThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->cc($this->faker->unique()->email);

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

        $mail = (new Email())->cc(...$emails);

        $this->assertMailCc($emails, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotCc
    |--------------------------------------------------------------------------
    */

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->cc($this->faker->unique()->email);

        $this->assertMailNotCc($email, $mail);
    }

    public function testMailNotSentToSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->cc($this->faker->unique()->email)
        );

        $this->assertMailNotCc($email, $mail);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->cc($email);

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

        $mail = (new Email())->cc(
            $this->faker->unique()->email,
            $this->faker->unique()->email
        );

        $this->assertMailNotCc($emails, $mail);
    }
}

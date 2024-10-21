<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class ToAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailSentTo
    |--------------------------------------------------------------------------
    */

    public function testMailSentToSingleEmail()
    {
        $email = $this->faker->email;

        $mail = (new Email())->to($email);

        $this->assertMailSentTo($email, $mail);
    }

    public function testMailSentToSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->to($email)
        );

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

    /*
    |--------------------------------------------------------------------------
    | assertMailNotSentTo
    |--------------------------------------------------------------------------
    */

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = (new Email())->to($this->faker->unique()->email);

        $this->assertMailNotSentTo($email, $mail);
    }

    public function testMailNotSentToSingleEmailViaAssertableMessage()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->to($this->faker->unique()->email)
        );

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

<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class CcAssertionsTest extends TestCase
{
    public function testMailCcSingleEmail()
    {
        $email = $this->faker->email;

        $mail = new AssertableMessage(
            (new Email())->cc($email)
        );

        $mail->assertCc($email);
    }

    public function testMailCcThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->cc($this->faker->unique()->email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not CC'd to the expected address [{$email}].");

        $mail->assertCc($email);
    }

    public function testMailSentToMultipleEmails()
    {
        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->cc(...$emails)
        );

        $mail->assertCc($emails);
    }

    public function testMailNotSentToSingleEmail()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->cc($this->faker->unique()->email)
        );

        $mail->assertNotCc($email);
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $email = $this->faker->unique()->email;

        $mail = new AssertableMessage(
            (new Email())->cc($email)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was CC'd to the expected address [{$email}].");

        $mail->assertNotCc($email);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        $mail = new AssertableMessage(
            (new Email())->cc(
                $this->faker->unique()->email,
                $this->faker->unique()->email
            )
        );

        $mail->assertNotCc($emails);
    }
}

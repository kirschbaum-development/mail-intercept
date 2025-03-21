<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Tests\TestCase;

class SubjectAssertionsTest extends TestCase
{
    public function testMailSubject()
    {
        $subject = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($subject)
        );

        $mail->assertSubject($subject);
    }

    public function testMailSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($this->faker->unique()->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was not [{$subject}].");

        $mail->assertSubject($subject);
    }

    public function testMailNotSubject()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($this->faker->unique()->sentence)
        );

        $mail->assertNotSubject($subject);
    }

    public function testMailNotSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($subject)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was [{$subject}].");

        $mail->assertNotSubject($subject);
    }
}

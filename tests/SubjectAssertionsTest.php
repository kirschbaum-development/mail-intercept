<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class SubjectAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailSubject
    |--------------------------------------------------------------------------
    */

    public function testMailSubject()
    {
        $subject = $this->faker->sentence;

        $mail = (new Email())->subject($subject);

        $this->assertMailSubject($subject, $mail);
    }

    public function testMailSubjectViaAssertableMessage()
    {
        $subject = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($subject)
        );

        $this->assertMailSubject($subject, $mail);
    }

    public function testMailSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = (new Email())->subject($this->faker->unique()->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was not [{$subject}].");

        $this->assertMailSubject($subject, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotSubject
    |--------------------------------------------------------------------------
    */

    public function testMailNotSubject()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = (new Email())->subject($this->faker->unique()->sentence);

        $this->assertMailNotSubject($subject, $mail);
    }

    public function testMailNotSubjectViaAssertableMessage()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())->subject($this->faker->unique()->sentence)
        );

        $this->assertMailNotSubject($subject, $mail);
    }

    public function testMailNotSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->sentence;

        $mail = (new Email())->subject($subject);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was [{$subject}].");

        $this->assertMailNotSubject($subject, $mail);
    }
}

<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\SubjectAssertions;

class SubjectAssertionsTest extends TestCase
{
    use WithFaker;
    use SubjectAssertions;

    public function testMailSubject()
    {
        $subject = $this->faker->sentence;

        $mail = (new Swift_Message())->setSubject($subject);

        $this->assertMailSubject($subject, $mail);
    }

    public function testMailSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = (new Swift_Message())->setSubject($this->faker->unique()->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was not [{$subject}].");

        $this->assertMailSubject($subject, $mail);
    }

    public function testMailNotSubject()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = (new Swift_Message())->setSubject($this->faker->unique()->sentence);

        $this->assertMailNotSubject($subject, $mail);
    }

    public function testMailNotSubjectThrowsProperExpectationFailedException()
    {
        $subject = $this->faker->sentence;

        $mail = (new Swift_Message())->setSubject($subject);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected subject was [{$subject}].");

        $this->assertMailNotSubject($subject, $mail);
    }
}

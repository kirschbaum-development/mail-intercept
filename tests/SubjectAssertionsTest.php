<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;

class SubjectAssertionsTest extends TestCase
{
    public function testMailSubject()
    {
        $subject = $this->faker->sentence;

        $mail = (new Email())->subject($subject);

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

    public function testMailNotSubject()
    {
        $subject = $this->faker->unique()->sentence;

        $mail = (new Email())->subject($this->faker->unique()->sentence);

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

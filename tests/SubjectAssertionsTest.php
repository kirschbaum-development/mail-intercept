<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class SubjectAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailSubject()
    {
        $this->interceptMail();

        $subject = $this->faker->sentence;

        Mail::send([], [], function ($message) use ($subject) {
            $message->subject($subject);
        });

        $this->assertMailSubject($subject, $this->interceptedMail()->first());
    }

    public function testMailSubjectThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $subject = $this->faker->unique()->sentence;

        Mail::send([], [], function ($message) {
            $message->subject($this->faker->unique()->sentence);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [Subject] was not set to [{$subject}].");

        $this->assertMailSubject($subject, $this->interceptedMail()->first());
    }

    public function testMailSubjectOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $subject = $this->faker->sentence;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($subject) {
                $message->subject($subject);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailSubject($subject, $mail);
        }
    }

    public function testMailNotSubject()
    {
        $this->interceptMail();

        $subject = $this->faker->unique()->sentence;

        Mail::send([], [], function ($message) {
            $message->subject($this->faker->unique()->sentence);
        });

        $this->assertMailNotSubject($subject, $this->interceptedMail()->first());
    }

    public function testMailNotSubjectThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $subject = $this->faker->sentence;

        Mail::send([], [], function ($message) use ($subject) {
            $message->subject($subject);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [Subject] was set to [{$subject}].");

        $this->assertMailNotSubject($subject, $this->interceptedMail()->first());
    }

    public function testMailNotSubjectOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $subject = $this->faker->unique()->sentence;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) {
                $message->subject($this->faker->unique()->sentence);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailNotSubject($subject, $mail);
        }
    }
}

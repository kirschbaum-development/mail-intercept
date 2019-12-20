<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class ContentAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailBodyContents()
    {
        $this->interceptMail();

        $content = $this->faker->sentence;

        Mail::send([], [], function ($message) use ($content) {
            $message->setBody($content);
        });

        $this->assertMailBodyContainsString($content, $this->interceptedMail()->first());
    }

    public function testMailBodyContentsThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $content = $this->faker->unique()->sentence;

        Mail::send([], [], function ($message) {
            $message->setBody($this->faker->unique()->sentence);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $this->assertMailBodyContainsString($content, $this->interceptedMail()->first());
    }

    public function testMailBodyContentInMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $content = $this->faker->sentence;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($content) {
                $message->setBody($content);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailBodyContainsString($content, $mail);
        }
    }

    public function testMailBodyDoesNotHaveContents()
    {
        $this->interceptMail();

        $content = $this->faker->unique()->sentence;

        Mail::send([], [], function ($message) {
            $message->setBody($this->faker->unique()->sentence);
        });

        $this->assertMailBodyNotContainsString($content, $this->interceptedMail()->first());
    }

    public function testMailBodyDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $content = $this->faker->sentence;

        Mail::send([], [], function ($message) use ($content) {
            $message->setBody($content);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $this->assertMailBodyNotContainsString($content, $this->interceptedMail()->first());
    }

    public function testMailBodyDoesNotHaveContentInMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $content = $this->faker->unique()->sentence;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) {
                $message->setBody($this->faker->unique()->sentence);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailBodyNotContainsString($content, $mail);
        }
    }
}

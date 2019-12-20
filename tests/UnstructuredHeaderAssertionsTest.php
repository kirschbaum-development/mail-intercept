<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailHasHeader()
    {
        $this->interceptMail();

        $header = $this->faker->slug;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->word);
        });

        $this->assertMailHasHeader($header, $this->interceptedMail()->first());
    }

    public function testMailHasHeaderThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $header = $this->faker->unique()->slug;

        Mail::send([], [], function ($message) {
            $message->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did not exist.");

        $this->assertMailHasHeader($header, $this->interceptedMail()->first());
    }

    public function testMailHasHeaderOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->slug;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($header) {
                $message->getHeaders()->addTextHeader($header, $this->faker->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailHasHeader($header, $mail);
        }
    }

    public function testMailMissingHeader()
    {
        $this->interceptMail();

        $header = $this->faker->unique()->slug;

        Mail::send([], [], function ($message) {
            $message->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
        });

        $this->assertMailMissingHeader($header, $this->interceptedMail()->first());
    }

    public function testMailMissingHeaderThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $header = $this->faker->slug;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->word);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did exist.");

        $this->assertMailMissingHeader($header, $this->interceptedMail()->first());
    }

    public function testMailMissingHeaderOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->unique()->slug;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) {
                $message->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailMissingHeader($header, $mail);
        }
    }

    public function testMailHeaderIs()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->word;

        Mail::send([], [], function ($message) use ($header, $value) {
            $message->getHeaders()->addTextHeader($header, $value);
        });

        $this->assertMailHeaderIs($header, $value, $this->interceptedMail()->first());
    }

    public function testMailHeaderIsThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was not set to [{$value}].");

        $this->assertMailHeaderIs($header, $value, $this->interceptedMail()->first());
    }

    public function testMailHeaderIsOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->slug;
        $value = $this->faker->word;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($header, $value) {
                $message->getHeaders()->addTextHeader($header, $value);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailHeaderIs($header, $value, $mail);
        }
    }

    public function testMailHeaderIsNot()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
        });

        $this->assertMailHeaderIsNot($header, $value, $this->interceptedMail()->first());
    }

    public function testMailHeaderIsNotThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->word;

        Mail::send([], [], function ($message) use ($header, $value) {
            $message->getHeaders()->addTextHeader($header, $value);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was set to [{$value}].");

        $this->assertMailHeaderIsNot($header, $value, $this->interceptedMail()->first());
    }

    public function testMailHeaderIsNotOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($header) {
                $message->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailHeaderIsNot($header, $value, $mail);
        }
    }
}

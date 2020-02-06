<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class BccAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailBccSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->bcc($email);
        });

        $this->assertMailBcc($email, $this->interceptedMail()->first());
    }

    public function testMailBccThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->bcc($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not BCC'd to the expected address [{$email}].");

        $this->assertMailBcc($email, $this->interceptedMail()->first());
    }

    public function testMailSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->bcc($emails);
        });

        $this->assertMailBcc($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailSentToDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) use ($email) {
                $message->bcc($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailBcc($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotSentToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->bcc($this->faker->unique()->email);
        });

        $this->assertMailNotBcc($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->bcc($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was BCC'd to the expected address [{$email}].");

        $this->assertMailNotBcc($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) {
            $message->bcc([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotBcc($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailNotSentToDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) {
                $message->bcc($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotBcc($email, $this->interceptedMail()[$key]);
        }
    }
}

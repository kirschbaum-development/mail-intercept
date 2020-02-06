<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class CcAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailCcSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->cc($email);
        });

        $this->assertMailCc($email, $this->interceptedMail()->first());
    }

    public function testMailCcThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->cc($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not CC'd to the expected address [{$email}].");

        $this->assertMailCc($email, $this->interceptedMail()->first());
    }

    public function testMailSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->cc($emails);
        });

        $this->assertMailCc($emails, $this->interceptedMail()->first());
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
                $message->cc($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailCc($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotSentToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->cc($this->faker->unique()->email);
        });

        $this->assertMailNotCc($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->cc($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was CC'd to the expected address [{$email}].");

        $this->assertMailNotCc($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) {
            $message->cc([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotCc($emails, $this->interceptedMail()->first());
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
                $message->cc($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotCc($email, $this->interceptedMail()[$key]);
        }
    }
}

<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class FromAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailSentFromSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->from($email);
        });

        $this->assertMailSentFrom($email, $this->interceptedMail()->first());
    }

    public function testMailSentFromThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->from($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent from the expected address [{$email}].");

        $this->assertMailSentFrom($email, $this->interceptedMail()->first());
    }

    public function testMailSentFromMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->from($emails);
        });

        $this->assertMailSentFrom($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailSentFromDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) use ($email) {
                $message->from($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailSentFrom($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotSentFromSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->from($this->faker->unique()->email);
        });

        $this->assertMailNotSentFrom($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentFromThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->from($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent from the expected address [{$email}].");

        $this->assertMailNotSentFrom($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentFromMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->from([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotSentFrom($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailNotSentFromDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) {
                $message->from($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotSentFrom($email, $this->interceptedMail()[$key]);
        }
    }
}

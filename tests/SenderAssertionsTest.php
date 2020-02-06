<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class SenderAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailSenderSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->sender($email);
        });

        $this->assertMailSender($email, $this->interceptedMail()->first());
    }

    public function testMailSenderThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->sender($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was not from the expected address [{$email}].");

        $this->assertMailSender($email, $this->interceptedMail()->first());
    }

    public function testMailSenderMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->sender($emails);
        });

        $this->assertMailSender($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailSenderDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) use ($email) {
                $message->sender($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailSender($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotSenderSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->sender($this->faker->unique()->email);
        });

        $this->assertMailNotSender($email, $this->interceptedMail()->first());
    }

    public function testMailNotSenderThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->sender($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail sender was from the expected address [{$email}].");

        $this->assertMailNotSender($email, $this->interceptedMail()->first());
    }

    public function testMailNotSenderMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->sender([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotSender($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailNotSenderDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) {
                $message->sender($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotSender($email, $this->interceptedMail()[$key]);
        }
    }
}

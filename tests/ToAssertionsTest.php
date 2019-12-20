<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class ToAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailSentToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->to($email);
        });

        $this->assertMailSentTo($email, $this->interceptedMail()->first());
    }

    public function testMailSentToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->to($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was not sent to the expected address [{$email}].");

        $this->assertMailSentTo($email, $this->interceptedMail()->first());
    }

    public function testMailSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->to($emails);
        });

        $this->assertMailSentTo($emails, $this->interceptedMail()->first());
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
                $message->to($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailSentTo($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotSentToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->to($this->faker->unique()->email);
        });

        $this->assertMailNotSentTo($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->to($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail was sent to the expected address [{$email}].");

        $this->assertMailNotSentTo($email, $this->interceptedMail()->first());
    }

    public function testMailNotSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) {
            $message->to([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotSentTo($emails, $this->interceptedMail()->first());
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
                $message->to($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotSentTo($email, $this->interceptedMail()[$key]);
        }
    }
}

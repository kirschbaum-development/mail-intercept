<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class ReplyToAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailRepliesToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->replyTo($email);
        });

        $this->assertMailRepliesTo($email, $this->interceptedMail()->first());
    }

    public function testMailRepliesToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->replyTo($this->faker->unique->email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail does not reply to the expected address [{$email}].");

        $this->assertMailRepliesTo($email, $this->interceptedMail()->first());
    }

    public function testMailRepliesToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->replyTo($emails);
        });

        $this->assertMailRepliesTo($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailRepliesToDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->email,
            $this->faker->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) use ($email) {
                $message->replyTo($email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailRepliesTo($email, $this->interceptedMail()[$key]);
        }
    }

    public function testMailNotRepliesToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->replyTo($this->faker->unique()->email);
        });

        $this->assertMailNotRepliesTo($email, $this->interceptedMail()->first());
    }

    public function testMailNotRepliesToThrowsProperExpectationFailedException()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->replyTo($email);
        });

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("Mail replied to the expected address [{$email}].");

        $this->assertMailNotRepliesTo($email, $this->interceptedMail()->first());
    }

    public function testMailNotRepliesToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) use ($emails) {
            $message->replyTo([
                $this->faker->unique()->email,
                $this->faker->unique()->email,
            ]);
        });

        $this->assertMailNotRepliesTo($emails, $this->interceptedMail()->first());
    }

    public function testDifferentMailNotRepliesToDifferentSingleEmail()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        foreach ($emails as $email) {
            Mail::send([], [], function ($message) {
                $message->replyTo($this->faker->unique()->email);
            });
        }

        foreach ($emails as $key => $email) {
            $this->assertMailNotRepliesTo($email, $this->interceptedMail()[$key]);
        }
    }
}

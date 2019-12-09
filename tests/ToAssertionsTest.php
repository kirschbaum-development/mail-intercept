<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
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

        $mail = $this->interceptedMail()->first();

        $this->assertMailSentTo($email, $mail);
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

        $mail = $this->interceptedMail()->first();

        $this->assertMailSentTo($emails, $mail);
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

        $mails = $this->interceptedMail();

        foreach ($emails as $key => $email) {
            $this->assertMailSentTo($email, $mails[$key]);
        }
    }

    public function testMailNotSentToSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->unique()->email;

        Mail::send([], [], function ($message) {
            $message->to($this->faker->unique()->email);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailNotSentTo($email, $mail);
    }

    public function testMailNotSentToMultipleEmails()
    {
        $this->interceptMail();

        $emails = [
            $this->faker->unique()->email,
            $this->faker->unique()->email,
        ];

        Mail::send([], [], function ($message) {
            $message->to($this->faker->unique()->email);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailNotSentTo($emails, $mail);
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

        $mails = $this->interceptedMail();

        foreach ($emails as $key => $email) {
            $this->assertMailNotSentTo($email, $mails[$key]);
        }
    }
}

<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class FromAssertionsTest extends TestCase
{
    use WithFaker,
        WithMailInterceptor;

    public function testMailSentFromSingleEmail()
    {
        $this->interceptMail();

        $email = $this->faker->email;

        Mail::send([], [], function ($message) use ($email) {
            $message->from($email);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailSentFrom($email, $mail);
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

        $mail = $this->interceptedMail()->first();

        $this->assertMailSentFrom($emails, $mail);
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

        $mails = $this->interceptedMail();

        foreach ($emails as $key => $email) {
            $this->assertMailSentFrom($email, $mails[$key]);
        }
    }
}

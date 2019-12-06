<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    use WithFaker,
        WithMailInterceptor;

    public function testMailHeader()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->word;

        Mail::send([], [], function ($message) use ($header, $value) {
            $message->getHeaders()->addTextHeader($header, $value);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailHasHeader($header, $mail, $value);
    }

    public function testMailHeaderOnMultipleEmails()
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
            $this->assertMailHasHeader($header, $mail, $value);
        }
    }
}

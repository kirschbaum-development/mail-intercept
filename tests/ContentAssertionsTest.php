<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class ContentAssertionsTest extends TestCase
{
    use WithFaker,
        WithMailInterceptor;

    public function testMailBodyContents()
    {
        $this->interceptMail();

        $content = $this->faker->sentence;

        Mail::send([], [], function ($message) use ($content) {
            $message->setBody($content);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailSentToMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $content = $this->faker->sentence;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($content) {
                $message->setBody($content);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailBodyContainsString($content, $mail);
        }
    }
}

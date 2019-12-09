<?php

namespace Tests;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailHasHeader()
    {
        $this->interceptMail();

        $header = $this->faker->slug;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->word);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailHasHeader($header, $mail);
    }

    public function testMailHasHeaderOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->slug;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($header) {
                $message->getHeaders()->addTextHeader($header, $this->faker->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailHasHeader($header, $mail);
        }
    }

    public function testMailMissingHeader()
    {
        $this->interceptMail();

        $header = $this->faker->unique()->slug;

        Mail::send([], [], function ($message) {
            $message->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailMissingHeader($header, $mail);
    }

    public function testMailMissingHeaderOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->unique()->slug;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) {
                $message->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailMissingHeader($header, $mail);
        }
    }

    public function testMailHeaderIs()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->word;

        Mail::send([], [], function ($message) use ($header, $value) {
            $message->getHeaders()->addTextHeader($header, $value);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    public function testMailHeaderIsOnMultipleEmails()
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
            $this->assertMailHeaderIs($header, $value, $mail);
        }
    }

    public function testMailHeaderIsNot()
    {
        $this->interceptMail();

        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        Mail::send([], [], function ($message) use ($header) {
            $message->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
        });

        $mail = $this->interceptedMail()->first();

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }

    public function testMailHeaderIsNotOnMultipleEmails()
    {
        $this->interceptMail();

        $emailCount = mt_rand(1, 5);

        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        for ($i = 0; $i < $emailCount; $i++) {
            Mail::send([], [], function ($message) use ($header) {
                $message->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
            });
        }

        $mails = $this->interceptedMail();

        $this->assertCount($emailCount, $mails);

        foreach ($mails as $mail) {
            $this->assertMailHeaderIsNot($header, $value, $mail);
        }
    }
}

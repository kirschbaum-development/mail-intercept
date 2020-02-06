<?php

namespace Tests;

use Swift_Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class ContentTypeAssertionsTest extends TestCase
{
    use WithFaker;
    use WithMailInterceptor;

    public function testMailContentTypePlain()
    {
        $mail = new Swift_Message();

        $this->assertMailIsPlain($mail);
    }

    public function testMailContentTypePlainThrowsException()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/bad');

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/plain].');

        $this->assertMailIsPlain($mail);
    }

    public function testMailContentTypeNotPlain()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/not-plain');

        $this->assertMailIsNotPlain($mail);
    }

    public function testMailContentTypeNotPlainThrowsException()
    {
        $mail = new Swift_Message();

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/plain].');

        $this->assertMailIsNotPlain($mail);
    }

    public function testMailContentTypeHtml()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/html');

        $this->assertMailIsHtml($mail);
    }

    public function testMailContentTypeHtmlThrowsException()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/bad');

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/html].');

        $this->assertMailIsHtml($mail);
    }

    public function testMailContentTypeNotHtml()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/not-html');

        $this->assertMailIsNotHtml($mail);
    }

    public function testMailContentTypeNotHtmlThrowsException()
    {
        $mail = new Swift_Message();
        $mail->setContentType('text/html');

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/html].');

        $this->assertMailIsNotHtml($mail);
    }
}

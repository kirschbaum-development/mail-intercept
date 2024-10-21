<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use Tests\TestCase;

class ContentTypeAssertionsTest extends TestCase
{
    public function testMailContentTypePlain()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
        );

        $mail->assertIsPlain();
    }

    public function testMailContentTypePlainThrowsException()
    {
        $part = new TextPart('body', subtype: 'bad');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/plain].');

        $mail->assertIsPlain();
    }

    public function testMailContentTypeNotPlain()
    {
        $part = new TextPart('body', subtype: 'not-plain');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $mail->assertIsNotPlain();
    }

    public function testMailContentTypeNotPlainThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/plain].');

        $mail->assertIsNotPlain();
    }

    public function testMailHasPlainContent()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $mail->assertHasPlainContent();
    }

    public function testMailHasPlainContentThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->html($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does not have [text/plain] content.');

        $mail->assertHasPlainContent();
    }

    public function testMailDoesNotHavePlainContent()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->html($this->faker->sentence)
        );

        $mail->assertDoesNotHavePlainContent();
    }

    public function testMailDoesNotHavePlainContentThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does have [text/plain] content.');

        $mail->assertDoesNotHavePlainContent();
    }

    public function testMailContentTypeHtml()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($this->faker->sentence)
        );

        $mail->assertIsHtml();
    }

    public function testMailContentTypeHtmlThrowsException()
    {
        $part = new TextPart('body', subtype: 'bad');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/html].');

        $mail->assertIsHtml();
    }

    public function testMailContentTypeNotHtml()
    {
        $part = new TextPart('body', subtype: 'not-html');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $mail->assertIsNotHtml();
    }

    public function testMailContentTypeNotHtmlThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/html].');

        $mail->assertIsNotHtml();
    }

    public function testMailHasHtmlContent()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $mail->assertHasHtmlContent();
    }

    public function testMailHasHtmlContentThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->text($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does not have [text/html] content.');

        $mail->assertHasHtmlContent();
    }

    public function testMailDoesNotHaveHtmlContent()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->text($this->faker->sentence)
        );

        $mail->assertDoesNotHaveHtmlContent();
    }

    public function testMailDoesNotHaveHtmlContentThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does have [text/html] content.');

        $mail->assertDoesNotHaveHtmlContent();
    }

    public function testMailContentTypeAlternative()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $mail->assertIsAlternative();
    }

    public function testMailContentTypeAlternativeThrowsException()
    {
        $part = new TextPart('body', subtype: 'not-alternative');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [multipart/alternative].');

        $mail->assertIsAlternative();
    }

    public function testMailContentTypeNotAlternative()
    {
        $part = new TextPart('body', subtype: 'not-alternative');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $mail->assertIsNotAlternative();
    }

    public function testMailContentTypeNotAlternativeThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->sentence)
                ->html($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [multipart/alternative].');

        $mail->assertIsNotAlternative();
    }

    public function testMailContentTypeMixed()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->text($this->faker->sentence)
        );

        $mail->assertIsMixed();
    }

    public function testMailContentTypeMixedThrowsException()
    {
        $part = new TextPart('body', subtype: 'not-mixed');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [multipart/mixed].');

        $mail->assertIsMixed();
    }

    public function testMailContentTypeNotMixed()
    {
        $part = new TextPart('body', subtype: 'not-mixed');
        $mail = new AssertableMessage(
            (new Email())->setBody($part)
        );

        $mail->assertIsNotMixed();
    }

    public function testMailContentTypeNotMixedThrowsException()
    {
        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->attach('attachment')
                ->text($this->faker->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [multipart/mixed].');

        $mail->assertIsNotMixed();
    }
}

<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use PHPUnit\Framework\ExpectationFailedException;

class ContentTypeAssertionsTest extends TestCase
{
    public function testMailContentTypePlain()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence);

        $this->assertMailIsPlain($mail);
    }

    public function testMailContentTypePlainThrowsException()
    {
        $part = new TextPart('body', subtype: 'bad');
        $mail = (new Email())->setBody($part);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/plain].');

        $this->assertMailIsPlain($mail);
    }

    public function testMailContentTypeNotPlain()
    {
        $part = new TextPart('body', subtype: 'not-plain');
        $mail = (new Email())->setBody($part);

        $this->assertMailIsNotPlain($mail);
    }

    public function testMailContentTypeNotPlainThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/plain].');

        $this->assertMailIsNotPlain($mail);
    }

    public function testMailHasPlainContent()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->assertMailHasPlainContent($mail);
    }

    public function testMailHasPlainContentThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->html($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does not have [text/plain] content.');

        $this->assertMailHasPlainContent($mail);
    }

    public function testMailDoesNotHavePlainContent()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->html($this->faker->sentence);

        $this->assertMailDoesNotHavePlainContent($mail);
    }

    public function testMailDoesNotHavePlainContentThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does have [text/plain] content.');

        $this->assertMailDoesNotHavePlainContent($mail);
    }

    public function testMailContentTypeHtml()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($this->faker->sentence);

        $this->assertMailIsHtml($mail);
    }

    public function testMailContentTypeHtmlThrowsException()
    {
        $part = new TextPart('body', subtype: 'bad');
        $mail = (new Email())->setBody($part);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [text/html].');

        $this->assertMailIsHtml($mail);
    }

    public function testMailContentTypeNotHtml()
    {
        $part = new TextPart('body', subtype: 'not-html');
        $mail = (new Email())->setBody($part);

        $this->assertMailIsNotHtml($mail);
    }

    public function testMailContentTypeNotHtmlThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [text/html].');

        $this->assertMailIsNotHtml($mail);
    }

    public function testMailHasHtmlContent()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->assertMailHasHtmlContent($mail);
    }

    public function testMailHasHtmlContentThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->text($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does not have [text/html] content.');

        $this->assertMailHasHtmlContent($mail);
    }

    public function testMailDoesNotHaveHtmlContent()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->text($this->faker->sentence);

        $this->assertMailDoesNotHaveHtmlContent($mail);
    }

    public function testMailDoesNotHaveHtmlContentThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail does have [text/html] content.');

        $this->assertMailDoesNotHaveHtmlContent($mail);
    }

    public function testMailContentTypeAlternative()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->assertMailIsAlternative($mail);
    }

    public function testMailContentTypeAlternativeThrowsException()
    {
        $part = new TextPart('body', subtype: 'not-alternative');
        $mail = (new Email())->setBody($part);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [multipart/alternative].');

        $this->assertMailIsAlternative($mail);
    }

    public function testMailContentTypeNotAlternative()
    {
        $part = new TextPart('body', subtype: 'not-alternative');
        $mail = (new Email())->setBody($part);

        $this->assertMailIsNotAlternative($mail);
    }

    public function testMailContentTypeNotAlternativeThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->sentence)
            ->html($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [multipart/alternative].');

        $this->assertMailIsNotAlternative($mail);
    }

    public function testMailContentTypeMixed()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->text($this->faker->sentence);

        $this->assertMailIsMixed($mail);
    }

    public function testMailContentTypeMixedThrowsException()
    {
        $part = new TextPart('body', subtype: 'not-mixed');
        $mail = (new Email())->setBody($part);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is not [multipart/mixed].');

        $this->assertMailIsMixed($mail);
    }

    public function testMailContentTypeNotMixed()
    {
        $part = new TextPart('body', subtype: 'not-mixed');
        $mail = (new Email())->setBody($part);

        $this->assertMailIsNotMixed($mail);
    }

    public function testMailContentTypeNotMixedThrowsException()
    {
        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->attach('attachment')
            ->text($this->faker->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The mail is [multipart/mixed].');

        $this->assertMailIsNotMixed($mail);
    }
}

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\AbstractMultipartPart;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait ContentTypeAssertions
{
    /**
     * Assert mail content type is text/plain.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsPlain(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            'plain',
            $mail->getBody()->getMediaSubtype(),
            'The mail is not [text/plain].'
        );
    }

    /**
     * Assert mail content type is not text/plain.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsNotPlain(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            'plain',
            $mail->getBody()->getMediaSubtype(),
            'The mail is [text/plain].'
        );
    }

    /**
     * Assert multipart email has text/plain content type.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailHasPlainContent(AssertableMessage | Email $mail): void
    {
        if ($mail->getBody() instanceof AbstractMultipartPart) {
            $hasPlainContent = collect($mail->getBody()->getParts())
                ->contains(fn ($part) => $part->getMediaSubtype() === 'plain');
        }

        $this->assertTrue(
            $hasPlainContent ?? false,
            'The mail does not have [text/plain] content.'
        );
    }

    /**
     * Assert multipart email does not have text/plain content type.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailDoesNotHavePlainContent(AssertableMessage | Email $mail): void
    {
        if ($mail->getBody() instanceof AbstractMultipartPart) {
            $hasPlainContent = collect($mail->getBody()->getParts())
                ->contains(fn ($part) => $part->getMediaSubtype() === 'plain');
        }

        $this->assertFalse(
            $hasPlainContent ?? true,
            'The mail does have [text/plain] content.'
        );
    }

    /**
     * Assert mail content type is text/html.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsHtml(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            'html',
            $mail->getBody()->getMediaSubtype(),
            'The mail is not [text/html].'
        );
    }

    /**
     * Assert mail content type is not text/html.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsNotHtml(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            'html',
            $mail->getBody()->getMediaSubtype(),
            'The mail is [text/html].'
        );
    }

    /**
     * Assert multipart email has text/html content type.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailHasHtmlContent(AssertableMessage | Email $mail): void
    {
        if ($mail->getBody() instanceof AbstractMultipartPart) {
            $hasHtmlContent = collect($mail->getBody()->getParts())
                ->contains(fn ($part) => $part->getMediaSubtype() === 'html');
        }

        $this->assertTrue(
            $hasHtmlContent ?? false,
            'The mail does not have [text/html] content.'
        );
    }

    /**
     * Assert multipart email does not have text/html content type.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailDoesNotHaveHtmlContent(AssertableMessage | Email $mail): void
    {
        if ($mail->getBody() instanceof AbstractMultipartPart) {
            $hasHtmlContent = collect($mail->getBody()->getParts())
                ->contains(fn ($part) => $part->getMediaSubtype() === 'html');
        }

        $this->assertFalse(
            $hasHtmlContent ?? true,
            'The mail does have [text/html] content.'
        );
    }

    /**
     * Assert mail content type is multipart/alternative.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsAlternative(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            'alternative',
            $mail->getBody()->getMediaSubtype(),
            'The mail is not [multipart/alternative].'
        );
    }

    /**
     * Assert mail content type is not multipart/alternative.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsNotAlternative(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            'alternative',
            $mail->getBody()->getMediaSubtype(),
            'The mail is [multipart/alternative].'
        );
    }

    /**
     * Assert mail content type is multipart/mixed.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsMixed(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            'mixed',
            $mail->getBody()->getMediaSubtype(),
            'The mail is not [multipart/mixed].'
        );
    }

    /**
     * Assert mail content type is not multipart/mixed.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailIsNotMixed(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            'mixed',
            $mail->getBody()->getMediaSubtype(),
            'The mail is [multipart/mixed].'
        );
    }
}

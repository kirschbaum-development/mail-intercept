<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\AbstractMultipartPart;

trait ContentTypeAssertions
{
    /**
     * Assert mail content type is text/plain.
     *
     * @param Email $mail
     */
    public function assertMailIsPlain(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsNotPlain(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailHasPlainContent(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailDoesNotHavePlainContent(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsHtml(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsNotHtml(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailHasHtmlContent(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailDoesNotHaveHtmlContent(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsAlternative(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsNotAlternative(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsMixed(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailIsNotMixed(Email $mail)
    {
        $this->assertNotEquals(
            'mixed',
            $mail->getBody()->getMediaSubtype(),
            'The mail is [multipart/mixed].'
        );
    }
}

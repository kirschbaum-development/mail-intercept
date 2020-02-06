<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;

trait ContentTypeAssertions
{
    /**
     * Assert mail content type is text/plain.
     *
     * @param Swift_Message $mail
     */
    public function assertMailIsPlain(Swift_Message $mail)
    {
        $this->assertEquals(
            'text/plain',
            $mail->getContentType(),
            'The mail is not [text/plain].'
        );
    }

    /**
     * Assert mail content type is not text/plain.
     *
     * @param Swift_Message $mail
     */
    public function assertMailIsNotPlain(Swift_Message $mail)
    {
        $this->assertNotEquals(
            'text/plain',
            $mail->getContentType(),
            'The mail is [text/plain].'
        );
    }

    /**
     * Assert mail content type is text/html.
     *
     * @param Swift_Message $mail
     */
    public function assertMailIsHtml(Swift_Message $mail)
    {
        $this->assertEquals(
            'text/html',
            $mail->getContentType(),
            'The mail is not [text/html].'
        );
    }

    /**
     * Assert mail content type is not text/html.
     *
     * @param Swift_Message $mail
     */
    public function assertMailIsNotHtml(Swift_Message $mail)
    {
        $this->assertNotEquals(
            'text/html',
            $mail->getContentType(),
            'The mail is [text/html].'
        );
    }

    // /**
    //  * Assert mail body contains string.
    //  *
    //  * @param string $needle
    //  * @param Swift_Message $mail
    //  */
    // public function assertMailBodyNotContainsString(string $needle, Swift_Message $mail)
    // {
    //     $this->assertStringNotContainsString(
    //         $needle,
    //         $mail->getBody(),
    //         "The expected [{$needle}] string was found in the body."
    //     );
    // }
}

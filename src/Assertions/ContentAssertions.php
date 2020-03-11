<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;

trait ContentAssertions
{
    /**
     * Assert mail body contains string.
     *
     * @param string $needle
     * @param Swift_Message $mail
     */
    public function assertMailBodyContainsString(string $needle, Swift_Message $mail)
    {
        $method = method_exists($this, 'assertStringContainsString')
            ? 'assertStringContainsString'
            : 'assertContains';

        $this->{$method}(
            $needle,
            $mail->getBody(),
            "The expected [{$needle}] string was not found in the body."
        );
    }

    /**
     * Assert mail body does not contain string.
     *
     * @param string $needle
     * @param Swift_Message $mail
     */
    public function assertMailBodyNotContainsString(string $needle, Swift_Message $mail)
    {
        $method = method_exists($this, 'assertStringNotContainsString')
            ? 'assertStringNotContainsString'
            : 'assertNotContains';

        $this->{$method}(
            $needle,
            $mail->getBody(),
            "The expected [{$needle}] string was found in the body."
        );
    }
}

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;

trait ContentAssertions
{
    /**
     * Assert mail body contains string.
     *
     * @param string $needle
     * @param Email $mail
     */
    public function assertMailBodyContainsString(string $needle, Email $mail)
    {
        $method = method_exists($this, 'assertStringContainsString')
            ? 'assertStringContainsString'
            : 'assertContains';

        $this->{$method}(
            $needle,
            $mail->getBody()->bodyToString(),
            "The expected [{$needle}] string was not found in the body."
        );
    }

    /**
     * Assert mail body does not contain string.
     *
     * @param string $needle
     * @param Email $mail
     */
    public function assertMailBodyNotContainsString(string $needle, Email $mail)
    {
        $method = method_exists($this, 'assertStringNotContainsString')
            ? 'assertStringNotContainsString'
            : 'assertNotContains';

        $this->{$method}(
            $needle,
            $mail->getBody()->bodyToString(),
            "The expected [{$needle}] string was found in the body."
        );
    }
}

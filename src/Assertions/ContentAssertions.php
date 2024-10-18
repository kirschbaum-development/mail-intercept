<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait ContentAssertions
{
    /**
     * Assert mail body contains string.
     */
    public function assertMailBodyContainsString(string $needle, AssertableMessage|Email $mail): void
    {
        $method = method_exists($this, 'assertStringContainsString')
            ? 'assertStringContainsString'
            : 'assertContains';

        $this->{$method}(
            $needle,
            $mail->getHtmlBody() ?: $mail->getBody()->bodyToString(),
            "The expected [{$needle}] string was not found in the body."
        );
    }

    /**
     * Assert mail body does not contain string.
     */
    public function assertMailBodyNotContainsString(string $needle, AssertableMessage|Email $mail): void
    {
        $method = method_exists($this, 'assertStringNotContainsString')
            ? 'assertStringNotContainsString'
            : 'assertNotContains';

        $this->{$method}(
            $needle,
            $mail->getHtmlBody() ?: $mail->getBody()->bodyToString(),
            "The expected [{$needle}] string was found in the body."
        );
    }
}

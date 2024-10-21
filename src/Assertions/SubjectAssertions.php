<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait SubjectAssertions
{
    /**
     * Assert mail has subject.
     */
    public function assertMailSubject(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have subject.
     */
    public function assertMailNotSubject(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was [{$expected}]."
        );
    }
}

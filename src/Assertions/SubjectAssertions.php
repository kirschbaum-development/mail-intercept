<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait SubjectAssertions
{
    /**
     * Assert mail has subject.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailSubject(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have subject.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotSubject(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was [{$expected}]."
        );
    }
}

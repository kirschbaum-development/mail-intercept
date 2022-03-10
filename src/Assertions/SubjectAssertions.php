<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;

trait SubjectAssertions
{
    /**
     * Assert mail has subject.
     *
     * @param string $expected
     * @param Email $mail
     */
    public function assertMailSubject(string $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailNotSubject(string $expected, Email $mail)
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was [{$expected}]."
        );
    }
}

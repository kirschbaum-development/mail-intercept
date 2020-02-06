<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;

trait SubjectAssertions
{
    /**
     * Assert mail has subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailSubject(string $expected, Swift_Message $mail)
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
     * @param Swift_Message $mail
     */
    public function assertMailNotSubject(string $expected, Swift_Message $mail)
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSubject(),
            "The expected subject was [{$expected}]."
        );
    }
}

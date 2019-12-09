<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\StringContains;

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
        $constraint = new StringContains($needle);

        static::assertThat(
            $mail->getBody(),
            $constraint,
            "Mail body does not contain string [ {$needle} ]."
        );
    }

    /**
     * Assert mail body contains string.
     *
     * @param string $needle
     * @param Swift_Message $mail
     */
    public function assertMailBodyNotContainsString(string $needle, Swift_Message $mail)
    {
        $constraint = new LogicalNot(new StringContains($needle));

        static::assertThat(
            $mail->getBody(),
            $constraint,
            "Mail body contains string [ {$needle} ]."
        );
    }
}

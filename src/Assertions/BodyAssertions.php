<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;

trait BodyAssertions
{
    /**
     * Assert mail body contains string.
     *
     * @param string $needle
     * @param Swift_Message $mail
     */
    public function assertMailBodyContainsString(string $needle, Swift_Message $mail)
    {
        $this->assertStringContainsString(
            $needle,
            $mail->getBody(),
            "Mail body does not contain string [ {$needle} ]."
        );
    }
}

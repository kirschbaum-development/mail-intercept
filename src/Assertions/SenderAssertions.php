<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait SenderAssertions
{
    /**
     * Assert mail sender was address.
     */
    public function assertMailSender(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getSender()->getAddress(),
            "Mail sender was not from the expected address [{$expected}]."
        );
    }

    /**
     * Assert mail was not sender address.
     */
    public function assertMailNotSender(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSender()->getAddress(),
            "Mail sender was from the expected address [{$expected}]."
        );
    }
}

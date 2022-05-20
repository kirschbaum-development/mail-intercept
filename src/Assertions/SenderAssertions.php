<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait SenderAssertions
{
    /**
     * Assert mail sender was address.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailSender(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getSender()->getAddress(),
            "Mail sender was not from the expected address [{$expected}]."
        );
    }

    /**
     * Assert mail was not sender address.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotSender(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSender()->getAddress(),
            "Mail sender was from the expected address [{$expected}]."
        );
    }
}

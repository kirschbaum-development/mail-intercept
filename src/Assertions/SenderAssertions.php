<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;

trait SenderAssertions
{
    /**
     * Assert mail sender was address.
     *
     * @param string $expected
     * @param Email $mail
     */
    public function assertMailSender(string $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailNotSender(string $expected, Email $mail)
    {
        $this->assertNotEquals(
            $expected,
            $mail->getSender()->getAddress(),
            "Mail sender was from the expected address [{$expected}]."
        );
    }
}

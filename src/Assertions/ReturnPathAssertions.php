<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait ReturnPathAssertions
{
    /**
     * Assert mail has return path.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailReturnPath(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getReturnPath()->getAddress(),
            "The expected return path was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have return path.
     *
     * @param string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotReturnPath(string $expected, AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getReturnPath()->getAddress(),
            "The expected return path was [{$expected}]."
        );
    }
}

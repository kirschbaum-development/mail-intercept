<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait ReturnPathAssertions
{
    /**
     * Assert mail has return path.
     */
    public function assertMailReturnPath(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getReturnPath()->getAddress(),
            "The expected return path was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have return path.
     */
    public function assertMailNotReturnPath(string $expected, AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getReturnPath()->getAddress(),
            "The expected return path was [{$expected}]."
        );
    }
}

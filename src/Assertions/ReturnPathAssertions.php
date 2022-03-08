<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;

trait ReturnPathAssertions
{
    /**
     * Assert mail has return path.
     *
     * @param string $expected
     * @param Email $mail
     */
    public function assertMailReturnPath(string $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailNotReturnPath(string $expected, Email $mail)
    {
        $this->assertNotEquals(
            $expected,
            $mail->getReturnPath()->getAddress(),
            "The expected return path was [{$expected}]."
        );
    }
}

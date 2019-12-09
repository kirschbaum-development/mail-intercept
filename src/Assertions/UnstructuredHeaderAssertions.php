<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Swift_Mime_Header;

trait UnstructuredHeaderAssertions
{
    /**
     * Assert mail has proper subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailSubject(string $expected, Swift_Message $mail)
    {
        $this->assertMailHasHeader('Subject', $mail, $expected);
    }

    /**
     * Assert unstructured header exists in mail.
     *
     * @param string $expected
     * @param Swift_Message $mail
     * @param string|null $expectedValue
     */
    public function assertMailHasHeader(string $expected, Swift_Message $mail, string $expectedValue = null)
    {
        $this->assertInstanceOf(
            Swift_Mime_Header::class,
            $mail->getHeaders()->get($expected),
            "Mail does not have header [ {$expected} ]."
        );

        if ($expectedValue) {
            $this->assertEquals(
                $expectedValue,
                $mail->getHeaders()->get($expected)->getValue(),
                "Mail header [ {$expected} ]  does not have the value of [ {$expectedValue} ]."
            );
        }
    }
}

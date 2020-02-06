<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Swift_Mime_Header;

trait UnstructuredHeaderAssertions
{
    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailHasHeader(string $expected, Swift_Message $mail)
    {
        $this->assertInstanceOf(
            Swift_Mime_Header::class,
            $mail->getHeaders()->get($expected),
            "The expected [{$expected}] header did not exist."
        );
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailMissingHeader(string $expected, Swift_Message $mail)
    {
        $this->assertNull(
            $mail->getHeaders()->get($expected),
            "The expected [{$expected}] header did exist."
        );
    }

    /**
     * Assert unstructured header is expected value.
     *
     * @param string $expected
     * @param string $expectedValue
     * @param Swift_Message $mail
     */
    public function assertMailHeaderIs(string $expected, string $expectedValue, Swift_Message $mail)
    {
        $this->assertEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue(),
            "The expected [{$expected}] was not set to [{$expectedValue}]."
        );
    }

    /**
     * Assert unstructured header is not expected value.
     *
     * @param string $expected
     * @param string $expectedValue
     * @param Swift_Message $mail
     */
    public function assertMailHeaderIsNot(string $expected, string $expectedValue, Swift_Message $mail)
    {
        $this->assertNotEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue(),
            "The expected [{$expected}] was set to [{$expectedValue}]."
        );
    }
}

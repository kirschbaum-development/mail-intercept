<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Swift_Mime_Header;

trait UnstructuredHeaderAssertions
{
    /**
     * Assert mail has subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailSubject(string $expected, Swift_Message $mail)
    {
        $this->assertMailHeaderIs('Subject', $expected, $mail);
    }

    /**
     * Assert mail does not have subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSubject(string $expected, Swift_Message $mail)
    {
        $this->assertMailHeaderIsNot('Subject', $expected, $mail);
    }

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
            $mail->getHeaders()->get($expected)
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
        $this->assertNull($mail->getHeaders()->get($expected));
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param string $expectedValue
     * @param Swift_Message $mail
     */
    public function assertMailHeaderIs(string $expected, string $expectedValue, Swift_Message $mail)
    {
        $this->assertEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue()
        );
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param string $expectedValue
     * @param Swift_Message $mail
     */
    public function assertMailHeaderIsNot(string $expected, string $expectedValue, Swift_Message $mail)
    {
        $this->assertNotEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue()
        );
    }
}

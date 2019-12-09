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
        $this->assertMailHeaderIs('Subject', $mail, $expected);
    }

    /**
     * Assert mail does not have subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSubject(string $expected, Swift_Message $mail)
    {
        $this->assertMailHeaderIsNot('Subject', $mail, $expected);
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
            $mail->getHeaders()->get($expected),
            "Mail does not have header [ {$expected} ]."
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
        static::assertThat(
            $mail->getHeaders()->get($expected),
            static::isNull(),
            "Mail has header [ {$expected} ]."
        );
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Swift_Message $mail
     * @param string|null $expectedValue
     */
    public function assertMailHeaderIs(string $expected, Swift_Message $mail, string $expectedValue = null)
    {
        $this->assertEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue(),
            "Mail header [ {$expected} ]  does not have the value of [ {$expectedValue} ]."
        );
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Swift_Message $mail
     * @param string|null $expectedValue
     */
    public function assertMailHeaderIsNot(string $expected, Swift_Message $mail, string $expectedValue = null)
    {
        $this->assertNotEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue(),
            "Mail header [ {$expected} ]  does not have the value of [ {$expectedValue} ]."
        );
    }
}

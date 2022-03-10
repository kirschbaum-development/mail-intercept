<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

trait UnstructuredHeaderAssertions
{
    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Email $mail
     */
    public function assertMailHasHeader(string $expected, Email $mail)
    {
        $this->assertInstanceOf(
            UnstructuredHeader::class,
            $mail->getHeaders()->get($expected),
            "The expected [{$expected}] header did not exist."
        );
    }

    /**
     * Assert unstructured header exists.
     *
     * @param string $expected
     * @param Email $mail
     */
    public function assertMailMissingHeader(string $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailHeaderIs(string $expected, string $expectedValue, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailHeaderIsNot(string $expected, string $expectedValue, Email $mail)
    {
        $this->assertNotEquals(
            $expectedValue,
            $mail->getHeaders()->get($expected)->getValue(),
            "The expected [{$expected}] was set to [{$expectedValue}]."
        );
    }
}

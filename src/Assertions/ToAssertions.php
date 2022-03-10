<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait ToAssertions
{
    /**
     * Assert mail was sent to address.
     *
     * @param array|string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailSentTo(array|string $expected, AssertableMessage|Email $mail)
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getTo', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail was not sent to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not sent to address.
     *
     * @param array|string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotSentTo(array|string $expected, AssertableMessage|Email $mail)
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getTo', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail was sent to the expected address [{$address}]."
            );
        }
    }
}

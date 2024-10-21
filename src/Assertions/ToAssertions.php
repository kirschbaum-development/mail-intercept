<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait ToAssertions
{
    /**
     * Assert mail was sent to address.
     */
    public function assertMailSentTo(array|string $expected, AssertableMessage|Email $mail): void
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
     */
    public function assertMailNotSentTo(array|string $expected, AssertableMessage|Email $mail): void
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

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait CcAssertions
{
    /**
     * Assert mail was CC'd to address.
     */
    public function assertMailCc(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getCc', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail was not CC'd to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not CC'd to address.
     */
    public function assertMailNotCc(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getCc', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail was CC'd to the expected address [{$address}]."
            );
        }
    }
}

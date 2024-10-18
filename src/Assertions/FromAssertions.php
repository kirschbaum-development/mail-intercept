<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait FromAssertions
{
    /**
     * Assert mail was sent from address.
     */
    public function assertMailSentFrom(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getFrom', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail was not sent from the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not sent from address.
     */
    public function assertMailNotSentFrom(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getFrom', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail was sent from the expected address [{$address}]."
            );
        }
    }
}

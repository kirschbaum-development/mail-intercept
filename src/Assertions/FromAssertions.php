<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait FromAssertions
{
    /**
     * Assert mail was sent from address.
     *
     * @param array|string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailSentFrom(array | string $expected, AssertableMessage | Email $mail): void
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
     *
     * @param array|string $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotSentFrom(array | string $expected, AssertableMessage | Email $mail): void
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

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait BccAssertions
{
    /**
     * Assert mail was BCC'd to address.
     */
    public function assertMailBcc(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getBcc', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail was not BCC'd to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not BCC'd to address.
     */
    public function assertMailNotBcc(array|string $expected, AssertableMessage|Email $mail): void
    {
        $addresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getBcc', $mail);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail was BCC'd to the expected address [{$address}]."
            );
        }
    }
}

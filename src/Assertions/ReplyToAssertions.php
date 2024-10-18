<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait ReplyToAssertions
{
    /**
     * Assert mail replies to address.
     */
    public function assertMailRepliesTo(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getReplyTo', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertContains(
                $address,
                $actualAddresses,
                "Mail does not reply to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail does not reply to address.
     */
    public function assertMailNotRepliesTo(array|string $expected, AssertableMessage|Email $mail): void
    {
        $expectedAddresses = Arr::wrap($expected);
        $actualAddresses = $this->gatherEmailData('getReplyTo', $mail);

        foreach ($expectedAddresses as $address) {
            $this->assertNotContains(
                $address,
                $actualAddresses,
                "Mail replied to the expected address [{$address}]."
            );
        }
    }
}

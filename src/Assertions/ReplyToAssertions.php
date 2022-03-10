<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Illuminate\Support\Arr;
use Symfony\Component\Mime\Email;

trait ReplyToAssertions
{
    /**
     * Assert mail replies to address.
     *
     * @param array|string $expected
     * @param Email $mail
     */
    public function assertMailRepliesTo(array|string $expected, Email $mail)
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
     *
     * @param array|string $expected
     * @param Email $mail
     */
    public function assertMailNotRepliesTo(array|string $expected, Email $mail)
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

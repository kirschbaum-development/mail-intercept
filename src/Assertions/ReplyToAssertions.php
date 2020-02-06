<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait ReplyToAssertions
{
    /**
     * Assert mail replies to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailRepliesTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertContains(
                $address,
                array_keys($mail->getReplyTo()),
                "Mail does not reply to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail does not reply to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotRepliesTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                array_keys($mail->getReplyTo()),
                "Mail replied to the expected address [{$address}]."
            );
        }
    }
}

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait ToAssertions
{
    /**
     * Assert mail was sent to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailSentTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            static::assertThat(
                in_array($address, $mail->getHeaders()->get('To')->getAddresses()),
                static::isTrue(),
                "Mail was not sent to [ {$address} ]"
            );
        }
    }

    /**
     * Assert mail was not sent to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSentTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            static::assertThat(
                in_array($address, $mail->getHeaders()->get('To')->getAddresses()),
                static::isFalse(),
                "Mail was sent to [ {$address} ]"
            );
        }
    }
}

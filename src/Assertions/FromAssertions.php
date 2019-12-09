<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait FromAssertions
{
    /**
     * Assert mail was sent from address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailSentFrom($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            static::assertThat(
                in_array($address, $mail->getHeaders()->get('From')->getAddresses()),
                static::isTrue(),
                "Mail was not sent from [ {$address} ]"
            );
        }
    }

    /**
     * Assert mail was not sent from address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSentFrom($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            static::assertThat(
                in_array($address, $mail->getHeaders()->get('From')->getAddresses()),
                static::isFalse(),
                "Mail was sent from [ {$address} ]"
            );
        }
    }
}

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
            $this->assertContains(
                $address,
                $mail->getHeaders()->get('From')->getAddresses(),
                "Mail was not sent from the expected address [{$address}]."
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
            $this->assertNotContains(
                $address,
                $mail->getHeaders()->get('From')->getAddresses(),
                "Mail was sent from the expected address [{$address}]."
            );
        }
    }
}

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait ToAssertions
{
    /**
     * Assert mail was sent to proper recipient.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailSentTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertTrue(
                in_array($address, $mail->getHeaders()->get('To')->getAddresses()),
                sprintf('Mail was sent to [ %s ]', $address)
            );
        }
    }

    /**
     * Assert mail was sent to proper recipient.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSentTo($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertFalse(
                in_array($address, $mail->getHeaders()->get('To')->getAddresses()),
                sprintf('Mail was sent to [ %s ]', $address)
            );
        }
    }
}

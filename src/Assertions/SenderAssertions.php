<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait SenderAssertions
{
    /**
     * Assert mail sender was address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailSender($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertContains(
                $address,
                array_keys($mail->getSender()),
                "Mail sender was not from the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not sender address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotSender($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                array_keys($mail->getSender()),
                "Mail sender was from the expected address [{$address}]."
            );
        }
    }
}

<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait BccAssertions
{
    /**
     * Assert mail was BCC'd to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailBcc($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertContains(
                $address,
                array_keys($mail->getBcc()),
                "Mail was not BCC'd to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not BCC'd to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotBcc($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                array_keys($mail->getBcc()),
                "Mail was BCC'd to the expected address [{$address}]."
            );
        }
    }
}

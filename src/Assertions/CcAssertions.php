<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait CcAssertions
{
    /**
     * Assert mail was CC'd to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailCc($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertContains(
                $address,
                array_keys($mail->getCc()),
                "Mail was not CC'd to the expected address [{$address}]."
            );
        }
    }

    /**
     * Assert mail was not CC'd to address.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailNotCc($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        foreach ($addresses as $address) {
            $this->assertNotContains(
                $address,
                array_keys($mail->getCc()),
                "Mail was CC'd to the expected address [{$address}]."
            );
        }
    }
}

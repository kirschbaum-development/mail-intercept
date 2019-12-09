<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Swift_Message;
use Illuminate\Support\Arr;

trait FromAssertions
{
    /**
     * Assert mail was sent from proper sender.
     *
     * @param string|array $expected
     * @param Swift_Message $mail
     */
    public function assertMailSentFrom($expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        $this->assertEmpty(
            array_diff($addresses, $mail->getHeaders()->get('From')->getAddresses()),
            sprintf('Mail was not sent from [ %s ].', implode(', ', Arr::wrap($addresses)))
        );
    }
}

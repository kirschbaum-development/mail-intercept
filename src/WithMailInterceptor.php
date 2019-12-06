<?php

namespace KirschbaumDevelopment\MailIntercept;

use Swift_Message;
use Swift_Mime_Header;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

trait WithMailInterceptor
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

        $this->assertEmpty(
            array_diff($addresses, $mail->getHeaders()->get('To')->getAddresses()),
            sprintf('Mail was not sent to [ %s ]', implode(', ', $addresses))
        );
    }

    /**
     * Assert mail was sent from proper sender.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailSentFrom(string $expected, Swift_Message $mail)
    {
        $addresses = Arr::wrap($expected);

        $this->assertEmpty(
            array_diff($addresses, $mail->getHeaders()->get('From')->getAddresses()),
            sprintf('Mail was not sent from [ %s ].', implode(', ', Arr::wrap($addresses)))
        );
    }

    /**
     * Assert mail has proper subject.
     *
     * @param string $expected
     * @param Swift_Message $mail
     */
    public function assertMailSubject(string $expected, Swift_Message $mail)
    {
        $this->assertMailHasHeader('Subject', $mail, $expected);
    }

    /**
     * Assert unstructured header exists in mail.
     *
     * @param string $expected
     * @param Swift_Message $mail
     * @param string|null $expectedValue
     */
    public function assertMailHasHeader(string $expected, Swift_Message $mail, string $expectedValue = null)
    {
        $this->assertInstanceOf(
            Swift_Mime_Header::class,
            $mail->getHeaders()->get($expected),
            "Mail does not have header [ {$expected} ]."
        );

        if ($expectedValue) {
            $this->assertEquals(
                $expectedValue,
                $mail->getHeaders()->get($expected)->getValue(),
                "Mail header [ {$expected} ]  does not have the value of [ {$expectedValue} ]."
            );
        }
    }

    /**
     * Assert mail body contains string.
     *
     * @param string $needle
     * @param Swift_Message $mail
     */
    public function assertMailBodyContainsString(string $needle, Swift_Message $mail)
    {
        $this->assertStringContainsString(
            $needle,
            $mail->getBody(),
            "Mail body does not contain string [ {$needle} ]."
        );
    }

    /**
     * Intercept Swift Mailer so we can dissect the mail.
     *
     * @return void
     */
    public function interceptMail(): void
    {
        Config::set('mail.driver', 'array');
    }

    /**
     * Retrieve email from internal array.
     *
     * @return Collection
     */
    public function interceptedMail(): Collection
    {
        return app('swift.transport')->driver()->messages();
    }
}

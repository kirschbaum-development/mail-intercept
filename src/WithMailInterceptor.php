<?php

namespace KirschbaumDevelopment\MailIntercept;

use Symfony\Component\Mime\Email;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Mailer\SentMessage;
use KirschbaumDevelopment\MailIntercept\Assertions\CcAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\BccAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\FromAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SenderAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ReplyToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SubjectAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\PriorityAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ReturnPathAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentTypeAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\UnstructuredHeaderAssertions;

trait WithMailInterceptor
{
    use CcAssertions;
    use ToAssertions;
    use BccAssertions;
    use FromAssertions;
    use SenderAssertions;
    use ContentAssertions;
    use ReplyToAssertions;
    use SubjectAssertions;
    use PriorityAssertions;
    use ReturnPathAssertions;
    use ContentTypeAssertions;
    use UnstructuredHeaderAssertions;

    /**
     * Intercept Symfony Mailer so we can dissect the mail.
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
        return app('mailer')->getSymfonyTransport()
            ->messages()
            ->map(function (SentMessage $message) {
                return new AssertableMessage($message->getOriginalMessage());
            });
    }

    /**
     * Gather email addresses from specific field method.
     *
     * @param string $method
     * @param AssertableMessage|Email $mail
     *
     * @return array
     */
    protected function gatherEmailData(string $method, AssertableMessage | Email $mail): array
    {
        return collect($mail->$method())
            ->map(fn ($address) => $address->getAddress())
            ->toArray();
    }
}

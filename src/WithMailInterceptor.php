<?php

namespace KirschbaumDevelopment\MailIntercept;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use KirschbaumDevelopment\MailIntercept\Assertions\AttachmentAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\BccAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\CcAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentTypeAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\FromAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\PriorityAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ReplyToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ReturnPathAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SenderAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SubjectAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\UnstructuredHeaderAssertions;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Email;

trait WithMailInterceptor
{
    use AttachmentAssertions;
    use BccAssertions;
    use CcAssertions;
    use ContentAssertions;
    use ContentTypeAssertions;
    use FromAssertions;
    use PriorityAssertions;
    use ReplyToAssertions;
    use ReturnPathAssertions;
    use SenderAssertions;
    use SubjectAssertions;
    use ToAssertions;
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
     */
    protected function gatherEmailData(string $method, AssertableMessage|Email $mail): array
    {
        return collect($mail->$method())
            ->map(fn ($address) => $address->getAddress())
            ->toArray();
    }
}

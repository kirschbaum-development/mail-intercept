<?php

namespace KirschbaumDevelopment\MailIntercept;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use KirschbaumDevelopment\MailIntercept\Assertions\ToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\CcAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\BccAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\FromAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SenderAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ReplyToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\SubjectAssertions;
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
    use UnstructuredHeaderAssertions;

    /**
     * Intercept Swift Mailer so we can dissect the mail.
     */
    public function interceptMail()
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

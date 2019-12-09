<?php

namespace KirschbaumDevelopment\MailIntercept;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use KirschbaumDevelopment\MailIntercept\Assertions\ToAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\FromAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentAssertions;
use KirschbaumDevelopment\MailIntercept\Assertions\UnstructuredHeaderAssertions;

trait WithMailInterceptor
{
    use ToAssertions;
    use FromAssertions;
    use ContentAssertions;
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

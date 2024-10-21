<?php

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

arch('WithMailInterceptor is a trait')->expect('KirschbaumDevelopment\MailIntercept\WithMailInterceptor')
    ->toBeTrait();

arch('WithMailInterceptor uses traits')->expect('KirschbaumDevelopment\MailIntercept\WithMailInterceptor')
    ->toUseTraits([
        BccAssertions::class,
        CcAssertions::class,
        ContentAssertions::class,
        ContentTypeAssertions::class,
        FromAssertions::class,
        PriorityAssertions::class,
        ReplyToAssertions::class,
        ReturnPathAssertions::class,
        SenderAssertions::class,
        SubjectAssertions::class,
        ToAssertions::class,
        UnstructuredHeaderAssertions::class,
    ]);

<?php

use Illuminate\Support\Traits\ForwardsCalls;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;
use PHPUnit\Framework\Assert;

arch('AssertableMessage extends Assert')->expect(AssertableMessage::class)
    ->toExtend(Assert::class);

arch('AssertableMessage uses traits')->expect(AssertableMessage::class)
    ->toUseTraits([
        ForwardsCalls::class,
        WithMailInterceptor::class,
    ]);

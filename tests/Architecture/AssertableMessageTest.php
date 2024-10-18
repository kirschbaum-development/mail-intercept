<?php

use Illuminate\Support\Traits\ForwardsCalls;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;
use PHPUnit\Framework\Assert;

arch()->expect(AssertableMessage::class)
    ->toExtend(Assert::class);

arch()->expect(AssertableMessage::class)
    ->toUseTraits([
        ForwardsCalls::class,
        WithMailInterceptor::class,
    ]);

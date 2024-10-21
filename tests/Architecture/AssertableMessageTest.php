<?php

use Illuminate\Support\Traits\ForwardsCalls;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;
use PHPUnit\Framework\Assert;

arch('AssertableMessage extends Assert')->expect(AssertableMessage::class)
    ->toExtend(Assert::class);

// Pest Presets are available beginning in version 3.
exec('composer show pestphp/pest', $output);

if ($output[3] === 'versions : * v3') {
    arch('AssertableMessage uses traits')->expect(AssertableMessage::class)
        ->toUseTraits([
            ForwardsCalls::class,
            WithMailInterceptor::class,
        ]);
}

<?php

arch('assertions are traits')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->toBeTraits();

arch('assertions have correct suffix')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->traits()
    ->toHaveSuffix('Assertions');

// Pest Presets are available beginning in version 3.
exec('composer show pestphp/pest', $output);

if ($output[3] === 'versions : * v3') {
    arch('assertions do not have private methods')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
        ->not->toHavePrivateMethods();

    arch('assertions do not have protected methods')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
        ->not->toHaveProtectedMethods();
}

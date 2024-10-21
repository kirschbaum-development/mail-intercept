<?php

arch('assertions are traits')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->toBeTraits();

arch('assertions have correct suffix')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->traits()
    ->toHaveSuffix('Assertions');

arch('assertions do not have private methods')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->not->toHavePrivateMethods();

arch('assertions do not have protected methods')->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->not->toHaveProtectedMethods();

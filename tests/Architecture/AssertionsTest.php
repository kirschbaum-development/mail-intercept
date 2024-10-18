<?php

arch()->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->toBeTraits();

arch()->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->traits()
    ->toHaveSuffix('Assertions');

arch()->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->not->toHavePrivateMethods();

arch()->expect('KirschbaumDevelopment\MailIntercept\Assertions')
    ->not->toHaveProtectedMethods();

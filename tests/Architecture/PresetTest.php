<?php

// Pest Presets are available beginning in version 3.
exec('composer show pestphp/pest', $output);

if ($output[3] === 'versions : * v3') {
    arch('laravel preset')->preset()->laravel();

    arch('php preset')->preset()->php();

    arch('security preset')->preset()->security();
}

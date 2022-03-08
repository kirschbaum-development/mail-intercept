<?php

namespace Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class TestCase extends OrchestraTestCase
{
    use WithFaker;
    use WithMailInterceptor;
}

<?php

namespace Tests;

use Illuminate\Support\Facades\Config;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class EnableInterceptionTest extends TestCase
{
    use WithMailInterceptor;

    public function testThatConfigIsProperlySet()
    {
        $this->interceptMail();

        $this->assertTrue(Config::has('mail.driver'));
        $this->assertEquals('array', Config::get('mail.driver'));
    }
}

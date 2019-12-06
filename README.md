# Laravel Mail Intercept
### A testing package for intercepting mail sent from Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Total Downloads](https://img.shields.io/packagist/dt/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/cc0749987c38426ebc8b0059c1171e27)](https://www.codacy.com/manual/Kirschbaum/mail-intercept?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=kirschbaum-development/mail-intercept&amp;utm_campaign=Badge_Grade)
[![Actions Status](https://github.com/kirschbaum-development/mail-intercept/workflows/CI/badge.svg)](https://github.com/kirschbaum-development/mail-intercept/actions)

This package contains an interceptor Laravel Mail just before they are sent out. This allows all kinds of assertions to be made on the actual emails themselves. 

This package does not fake any email. You get to inspect the actual mail ensuring you are sending exactly what you want!

## Requirements

This testing package requires Laravel 5.5 or higher.

## Installation

```bash
composer require-dev kirschbaum-development/mail-intercept
```

## Usage

Next you can use the `KirschbaumDevelopment\MailIntercept\WithMailInterceptor` trait in your test class:

```php
namespace Tests;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use KirschbaumDevelopment\MailIntercept\WithMailInterceptor;

class MailTest extends TestCase
{
    use WithFaker,
        WithMailInterceptor;

    public function testMail()
    {
        $this->interceptMail();

        $email = $this->faker->email;
        
        Mail::to($email)->send(new TestMail());

        $interceptedMail = $this->interceptedMail()->first();

        $this->assertMailSentTo($email, $interceptedMail);
    }
}
```

That's it! Pretty simple, right?!

### Testing API

```php
$this->interceptMail()
```

MUST be called first. Similar to `Mail::fake()` which must be called before the email is sent, but unlike the mail fake, this doesn't fake email, it intercepts the compiled email. 

```php
$this->interceptedMail()
```

This should be called after `Mail` has been sent, but before your assertions, otherwise you won't have any emails to work with. It returns a `Collection` of emails so you are free to use any of the methods available to a collection.

```php
$this->assertMailSentTo($to, $mail);
$this->assertMailSentFrom($from, $mail);
$this->assertMailSubject($subject, $mail);
```

These assertions methods each accept a string as the expected first parameter and a compiled email as the second parameter. Each item of the `interceptedMail()` collection is the proper mail object.

```php
$this->assertMailHasHeader($header, $mail, $headerValue);
```

If you are injecting your own headers or need access to other headers in the email, use this assertion to verify they exist and are set properly.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email brandon@kirschbaumdevelopment.com or nathan@kirschbaumdevelopment.com instead of using the issue tracker.

## Credits

- [Brandon Ferens](https://github.com/brandonferens)

## Sponsorship

Development of this package is sponsored by Kirschbaum Development Group, a developer driven company focused on problem solving, team building, and community. Learn more [about us](https://kirschbaumdevelopment.com) or [join us](https://careers.kirschbaumdevelopment.com)!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

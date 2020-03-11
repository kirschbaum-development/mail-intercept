![Mail Intercept banner](https://raw.githubusercontent.com/kirschbaum-development/mail-intercept/master/screenshots/banner.png)

# Laravel Mail Intercept
### A testing package for intercepting mail sent from Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Total Downloads](https://img.shields.io/packagist/dt/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/cc0749987c38426ebc8b0059c1171e27)](https://www.codacy.com/manual/Kirschbaum/mail-intercept?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=kirschbaum-development/mail-intercept&amp;utm_campaign=Badge_Grade)
[![Actions Status](https://github.com/kirschbaum-development/mail-intercept/workflows/CI/badge.svg)](https://github.com/kirschbaum-development/mail-intercept/actions)

This testing suite intercepts Laravel Mail just before they are sent out, allowing all kinds of assertions to be made on the actual emails themselves.

Mail isn't faked here. You get to inspect the actual mail ensuring you are sending exactly what you want!

## Requirements

This testing package requires Laravel 5.5 or higher.

## Installation

```bash
composer require kirschbaum-development/mail-intercept --dev
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

This method MUST be called first, similar to how `Mail::fake()` works. But unlike the mail fake, mail is not faked, it is intercepted. 

```php
$this->interceptedMail()
```

This should be called after `Mail` has been sent, but before your assertions, otherwise you won't have any emails to work with. It returns a `Collection` of emails so you are free to use any of the methods available to a collection.

| Assertions                                                 | Parameters                                        |
|:---------------------------------------------------------- |:--------------------------------------------------|
| `$this->assertMailSentTo($to, $mail);`                     | `$to` string, array<br/>`$mail` Swift_Message     |
| `$this->assertMailNotSentTo($to, $mail);`                  | `$to` string, array<br/>`$mail` Swift_Message     |
| `$this->assertMailSentFrom($from, $mail);`                 | `$from` string, array<br/>`$mail` Swift_Message   |
| `$this->assertMailNotSentFrom($from, $mail);`              | `$from` string, array<br/>`$mail` Swift_Message   |
| `$this->assertMailSubject($subject, $mail);`               | `$subject` string<br/>`$mail` Swift_Message       |
| `$this->assertMailNotSubject($subject, $mail);`            | `$subject` string<br/>`$mail` Swift_Message       |
| `$this->assertMailBodyContainsString($content, $mail);`    | `$content` string<br/>`$mail` Swift_Message       |
| `$this->assertMailBodyNotContainsString($content, $mail);` | `$content` string<br/>`$mail` Swift_Message       |
| `$this->assertMailRepliesTo($reply, $mail);`               | `$reply` string, array<br/>`$mail` Swift_Message  |
| `$this->assertMailNotRepliesTo($reply, $mail);`            | `$reply` string, array<br/>`$mail` Swift_Message  |
| `$this->assertMailCc($cc, $mail);`                         | `$cc` string, array<br/>`$mail` Swift_Message     |
| `$this->assertMailNotCc($cc, $mail);`                      | `$cc` string, array<br/>`$mail` Swift_Message     |
| `$this->assertMailBcc($cc, $mail);`                        | `$bcc` string, array<br/>`$mail` Swift_Message    |
| `$this->assertMailNotBcc($cc, $mail);`                     | `$bcc` string, array<br/>`$mail` Swift_Message    |
| `$this->assertMailSender($sender, $mail);`                 | `$sender` string, array<br/>`$mail` Swift_Message |
| `$this->assertMailNotSender($sender, $mail);`              | `$sender` string, array<br/>`$mail` Swift_Message |
| `$this->assertMailIsPlain($mail);`                         | `$mail` Swift_Message                             |
| `$this->assertMailIsNotPlain($mail);`                      | `$mail` Swift_Message                             |
| `$this->assertMailIsHtml($mail);`                          | `$mail` Swift_Message                             |
| `$this->assertMailIsNotHtml($mail);`                       | `$mail` Swift_Message                             |

| Header Assertions                                       | Parameters                                                     |
|:------------------------------------------------------- |:---------------------------------------------------------------|
| `$this->assertMailHasHeader($header, $mail);`           | `$header` string<br/>`$mail` Swift_Message                     |
| `$this->assertMailMissingHeader($header, $mail);`       | `$header` string<br/>`$mail` Swift_Message                     |
| `$this->assertMailHeaderIs($header, $value, $mail);`    | `$header` string<br/>`$value` string<br/>`$mail` Swift_Message |
| `$this->assertMailHeaderIsNot($header, $value, $mail);` | `$header` string<br/>`$value` string<br/>`$mail` Swift_Message |

You should use each item of the `interceptedMail()` collection as the mail object for all assertions.

If you are injecting your own headers or need access to other headers in the email, use this assertion to verify they exist and are set properly. These assertions require the header name and the compiled email.

### Other assertions

Since `$this->interceptedMail()` returns a collection of `Swift_Message` objects, you are free to dissect and look into those objects using any methods available to Swift's Message API. Head over to the [Swift Mail Docs](https://swiftmailer.symfony.com/docs/introduction.html) for more detailed info.

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

![Mail Intercept banner](screenshots/banner.jpg)

# Laravel Mail Intercept
### A testing package for intercepting mail sent from Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Total Downloads](https://img.shields.io/packagist/dt/kirschbaum-development/mail-intercept.svg)](https://packagist.org/packages/kirschbaum-development/mail-intercept)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/cc0749987c38426ebc8b0059c1171e27)](https://www.codacy.com/manual/Kirschbaum/mail-intercept?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=kirschbaum-development/mail-intercept&amp;utm_campaign=Badge_Grade)
[![Actions Status](https://github.com/kirschbaum-development/mail-intercept/workflows/CI/badge.svg)](https://github.com/kirschbaum-development/mail-intercept/actions)

This testing suite intercepts Laravel Mail just before they are sent out, allowing all kinds of assertions to be made on the actual emails themselves.

Mail isn't faked here. You get to inspect the actual mail ensuring you are sending exactly what you want!

## Requirements

| Laravel Version  | Mail Intercept Version  |
|:-----------------|:------------------------|
| 9.x              | 0.3.x                   |
| 8.x and lower    | 0.2.x                   |

Please note: If you are using `v0.2.x`, please refer to that version's [documentation](https://github.com/kirschbaum-development/mail-intercept/tree/v0.2.x).

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
    use WithFaker;
    use WithMailInterceptor;

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

| Assertions                                                 | Parameters                                |
|:-----------------------------------------------------------|:------------------------------------------|
| `$this->assertMailSentTo($to, $mail);`                     | `$to` array, string<br/>`$mail` Email     |
| `$this->assertMailNotSentTo($to, $mail);`                  | `$to` array, string<br/>`$mail` Email     |
| `$this->assertMailSentFrom($from, $mail);`                 | `$from` array, string<br/>`$mail` Email   |
| `$this->assertMailNotSentFrom($from, $mail);`              | `$from` array, string<br/>`$mail` Email   |
| `$this->assertMailSubject($subject, $mail);`               | `$subject` string<br/>`$mail` Email       |
| `$this->assertMailNotSubject($subject, $mail);`            | `$subject` string<br/>`$mail` Email       |
| `$this->assertMailBodyContainsString($content, $mail);`    | `$content` string<br/>`$mail` Email       |
| `$this->assertMailBodyNotContainsString($content, $mail);` | `$content` string<br/>`$mail` Email       |
| `$this->assertMailRepliesTo($reply, $mail);`               | `$reply` array, string<br/>`$mail` Email  |
| `$this->assertMailNotRepliesTo($reply, $mail);`            | `$reply` array, string<br/>`$mail` Email  |
| `$this->assertMailCc($cc, $mail);`                         | `$cc` array, string<br/>`$mail` Email     |
| `$this->assertMailNotCc($cc, $mail);`                      | `$cc` array, string<br/>`$mail` Email     |
| `$this->assertMailBcc($cc, $mail);`                        | `$bcc` array, string<br/>`$mail` Email    |
| `$this->assertMailNotBcc($cc, $mail);`                     | `$bcc` array, string<br/>`$mail` Email    |
| `$this->assertMailSender($sender, $mail);`                 | `$sender` array, string<br/>`$mail` Email |
| `$this->assertMailNotSender($sender, $mail);`              | `$sender` array, string<br/>`$mail` Email |
| `$this->assertMailReturnPath($returnPath, $mail);`         | `$returnPath` string<br/>`$mail` Email    |
| `$this->assertMailNotReturnPath($returnPath, $mail);`      | `$returnPath` string<br/>`$mail` Email    |

| Content Type Assertions                            | Parameters    |
|:---------------------------------------------------|:--------------|
| `$this->assertMailIsPlain($mail);`                 | `$mail` Email |
| `$this->assertMailIsNotPlain($mail);`              | `$mail` Email |
| `$this->assertMailHasPlainContent($mail);`         | `$mail` Email |
| `$this->assertMailDoesNotHavePlainContent($mail);` | `$mail` Email |
| `$this->assertMailIsHtml($mail);`                  | `$mail` Email |
| `$this->assertMailIsNotHtml($mail);`               | `$mail` Email |
| `$this->assertMailHasHtmlContent($mail);`          | `$mail` Email |
| `$this->assertMailDoesNotHaveHtmlContent($mail);`  | `$mail` Email |
| `$this->assertMailIsAlternative($mail);`           | `$mail` Email |
| `$this->assertMailIsNotAlternative($mail);`        | `$mail` Email |
| `$this->assertMailIsMixed($mail);`                 | `$mail` Email |
| `$this->assertMailIsNotMixed($mail);`              | `$mail` Email |

| Header Assertions                                       | Parameters                                             |
|:--------------------------------------------------------|:-------------------------------------------------------|
| `$this->assertMailHasHeader($header, $mail);`           | `$header` string<br/>`$mail` Email                     |
| `$this->assertMailMissingHeader($header, $mail);`       | `$header` string<br/>`$mail` Email                     |
| `$this->assertMailHeaderIs($header, $value, $mail);`    | `$header` string<br/>`$value` string<br/>`$mail` Email |
| `$this->assertMailHeaderIsNot($header, $value, $mail);` | `$header` string<br/>`$value` string<br/>`$mail` Email |

| Priority Assertions                               | Parameters                        |
|:--------------------------------------------------|:----------------------------------|
| `$this->assertMailPriority($priority, $mail);`    | `$priority` int<br/>`$mail` Email |
| `$this->assertMailNotPriority($priority, $mail);` | `$priority` int<br/>`$mail` Email |
| `$this->assertMailPriorityIsHighest($mail);`      | `$mail` Email                     |
| `$this->assertMailPriorityNotHighest($mail);`     | `$mail` Email                     |
| `$this->assertMailPriorityIsHigh($mail);`         | `$mail` Email                     |
| `$this->assertMailPriorityNotHigh($mail);`        | `$mail` Email                     |
| `$this->assertMailPriorityIsNormal($mail);`       | `$mail` Email                     |
| `$this->assertMailPriorityNotNormal($mail);`      | `$mail` Email                     |
| `$this->assertMailPriorityIsLow($mail);`          | `$mail` Email                     |
| `$this->assertMailPriorityNotLow($mail);`         | `$mail` Email                     |
| `$this->assertMailPriorityIsLowest($mail);`       | `$mail` Email                     |
| `$this->assertMailPriorityIsLowest($mail);`       | `$mail` Email                     |

You should use each item of the `interceptedMail()` collection as the mail object for all assertions.

If you are injecting your own headers or need access to other headers in the email, use this assertion to verify they exist and are set properly. These assertions require the header name and the compiled email.

### Other assertions

Since `$this->interceptedMail()` returns a collection of `Symfony\Component\Mime\Email` objects, you are free to dissect and look into those objects using any methods available to Symfony's Email API. Head over to the [Symfony Email Docs](https://symfony.com/doc/current/mailer.html) for more detailed info.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email brandon@kirschbaumdevelopment.com or nathan@kirschbaumdevelopment.com instead of using the issue tracker.

## Credits

- [Brandon Ferens](https://github.com/brandonferens)
- [Michael Fox](https://github.com/michaelfox)

## Sponsorship

Development of this package is sponsored by Kirschbaum Development Group, a developer driven company focused on problem solving, team building, and community. Learn more [about us](https://kirschbaumdevelopment.com) or [join us](https://careers.kirschbaumdevelopment.com)!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

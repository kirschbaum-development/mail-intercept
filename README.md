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
| 10.x             | 0.4.x                   |
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

        $interceptedMail->assertSentTo($email);
    }
}
```

That's it! Pretty simple, right?!

There are two ways of accessing the assertions. First is the fluent syntax directly on each intercepted email.

```php
$interceptedMail->assertSentTo($email);
```

The other way (the older way) is to use the assertions methods made available from the `WithMailInterceptor` trait. Using these methods are fine, but aren't as clean to write.

```php
$this->assertMailSentTo($email, $interceptedEmail);
```

Both of these assertions do the exact same thing, the fluent one is just much cleaner. See all the available assertion methods below!

### Testing API

```php
$this->interceptMail()
```

This method MUST be called first, similar to how `Mail::fake()` works. But unlike the mail fake, mail is not faked, it is intercepted.

```php
$this->interceptedMail()
```

This should be called after `Mail` has been sent, but before your assertions, otherwise you won't have any emails to work with. It returns a `Collection` of emails so you are free to use any of the methods available to a collection.

#### Fluent Assertion Methods

| Assertions                                             | Parameters              |
|:-------------------------------------------------------|:------------------------|
| `$intercepted->assertSentTo($to);`                     | `$to` array, string     |
| `$intercepted->assertNotSentTo($to);`                  | `$to` array, string     |
| `$intercepted->assertSentFrom($from);`                 | `$from` array, string   |
| `$intercepted->assertNotSentFrom($from);`              | `$from` array, string   |
| `$intercepted->assertSubject($subject);`               | `$subject` string       |
| `$intercepted->assertNotSubject($subject);`            | `$subject` string       |
| `$intercepted->assertBodyContainsString($content);`    | `$content` string       |
| `$intercepted->assertBodyNotContainsString($content);` | `$content` string       |
| `$intercepted->assertRepliesTo($reply);`               | `$reply` array, string  |
| `$intercepted->assertNotRepliesTo($reply);`            | `$reply` array, string  |
| `$intercepted->assertCc($cc);`                         | `$cc` array, string     |
| `$intercepted->assertNotCc($cc);`                      | `$cc` array, string     |
| `$intercepted->assertBcc($cc);`                        | `$bcc` array, string    |
| `$intercepted->assertNotBcc($cc);`                     | `$bcc` array, string    |
| `$intercepted->assertSender($sender);`                 | `$sender` array, string |
| `$intercepted->assertNotSender($sender);`              | `$sender` array, string |
| `$intercepted->assertReturnPath($returnPath);`         | `$returnPath` string    |
| `$intercepted->assertNotReturnPath($returnPath);`      | `$returnPath` string    |

| Content Type Assertions                          |
|:-------------------------------------------------|
| `$intercepted->assertIsPlain();`                 |
| `$intercepted->assertIsNotPlain();`              |
| `$intercepted->assertHasPlainContent();`         |
| `$intercepted->assertDoesNotHavePlainContent();` |
| `$intercepted->assertIsHtml();`                  |
| `$intercepted->assertIsNotHtml();`               |
| `$intercepted->assertHasHtmlContent();`          |
| `$intercepted->assertDoesNotHaveHtmlContent();`  |
| `$intercepted->assertIsAlternative();`           |
| `$intercepted->assertIsNotAlternative();`        |
| `$intercepted->assertIsMixed();`                 |
| `$intercepted->assertIsNotMixed();`              |

| Header Assertions                                   | Parameters                           |
|:----------------------------------------------------|:-------------------------------------|
| `$intercepted->assertHasHeader($header);`           | `$header` string                     |
| `$intercepted->assertMissingHeader($header);`       | `$header` string                     |
| `$intercepted->assertHeaderIs($header, $value);`    | `$header` string<br/>`$value` string |
| `$intercepted->assertHeaderIsNot($header, $value);` | `$header` string<br/>`$value` string |

| Priority Assertions                           | Parameters      |
|:----------------------------------------------|:----------------|
| `$intercepted->assertPriority($priority);`    | `$priority` int |
| `$intercepted->assertNotPriority($priority);` | `$priority` int |
| `$intercepted->assertPriorityIsHighest();`    |                 |
| `$intercepted->assertPriorityNotHighest();`   |                 |
| `$intercepted->assertPriorityIsHigh();`       |                 |
| `$intercepted->assertPriorityNotHigh();`      |                 |
| `$intercepted->assertPriorityIsNormal();`     |                 |
| `$intercepted->assertPriorityNotNormal();`    |                 |
| `$intercepted->assertPriorityIsLow();`        |                 |
| `$intercepted->assertPriorityNotLow();`       |                 |
| `$intercepted->assertPriorityIsLowest();`     |                 |
| `$intercepted->assertPriorityIsLowest();`     |                 |

#### Assertion Methods

| Assertions                                                 | Parameters                                                   |
|:-----------------------------------------------------------|:-------------------------------------------------------------|
| `$this->assertMailSentTo($to, $mail);`                     | `$to` array, string<br/>`$mail` AssertableMessage, Email     |
| `$this->assertMailNotSentTo($to, $mail);`                  | `$to` array, string<br/>`$mail` AssertableMessage, Email     |
| `$this->assertMailSentFrom($from, $mail);`                 | `$from` array, string<br/>`$mail` AssertableMessage, Email   |
| `$this->assertMailNotSentFrom($from, $mail);`              | `$from` array, string<br/>`$mail` AssertableMessage, Email   |
| `$this->assertMailSubject($subject, $mail);`               | `$subject` string<br/>`$mail` AssertableMessage, Email       |
| `$this->assertMailNotSubject($subject, $mail);`            | `$subject` string<br/>`$mail` AssertableMessage, Email       |
| `$this->assertMailBodyContainsString($content, $mail);`    | `$content` string<br/>`$mail` AssertableMessage, Email       |
| `$this->assertMailBodyNotContainsString($content, $mail);` | `$content` string<br/>`$mail` AssertableMessage, Email       |
| `$this->assertMailRepliesTo($reply, $mail);`               | `$reply` array, string<br/>`$mail` AssertableMessage, Email  |
| `$this->assertMailNotRepliesTo($reply, $mail);`            | `$reply` array, string<br/>`$mail` AssertableMessage, Email  |
| `$this->assertMailCc($cc, $mail);`                         | `$cc` array, string<br/>`$mail` AssertableMessage, Email     |
| `$this->assertMailNotCc($cc, $mail);`                      | `$cc` array, string<br/>`$mail` AssertableMessage, Email     |
| `$this->assertMailBcc($cc, $mail);`                        | `$bcc` array, string<br/>`$mail` AssertableMessage, Email    |
| `$this->assertMailNotBcc($cc, $mail);`                     | `$bcc` array, string<br/>`$mail` AssertableMessage, Email    |
| `$this->assertMailSender($sender, $mail);`                 | `$sender` array, string<br/>`$mail` AssertableMessage, Email |
| `$this->assertMailNotSender($sender, $mail);`              | `$sender` array, string<br/>`$mail` AssertableMessage, Email |
| `$this->assertMailReturnPath($returnPath, $mail);`         | `$returnPath` string<br/>`$mail` AssertableMessage, Email    |
| `$this->assertMailNotReturnPath($returnPath, $mail);`      | `$returnPath` string<br/>`$mail` AssertableMessage, Email    |

| Content Type Assertions                            | Parameters                       |
|:---------------------------------------------------|:---------------------------------|
| `$this->assertMailIsPlain($mail);`                 | `$mail` AssertableMessage, Email |
| `$this->assertMailIsNotPlain($mail);`              | `$mail` AssertableMessage, Email |
| `$this->assertMailHasPlainContent($mail);`         | `$mail` AssertableMessage, Email |
| `$this->assertMailDoesNotHavePlainContent($mail);` | `$mail` AssertableMessage, Email |
| `$this->assertMailIsHtml($mail);`                  | `$mail` AssertableMessage, Email |
| `$this->assertMailIsNotHtml($mail);`               | `$mail` AssertableMessage, Email |
| `$this->assertMailHasHtmlContent($mail);`          | `$mail` AssertableMessage, Email |
| `$this->assertMailDoesNotHaveHtmlContent($mail);`  | `$mail` AssertableMessage, Email |
| `$this->assertMailIsAlternative($mail);`           | `$mail` AssertableMessage, Email |
| `$this->assertMailIsNotAlternative($mail);`        | `$mail` AssertableMessage, Email |
| `$this->assertMailIsMixed($mail);`                 | `$mail` AssertableMessage, Email |
| `$this->assertMailIsNotMixed($mail);`              | `$mail` AssertableMessage, Email |

| Header Assertions                                       | Parameters                                                                |
|:--------------------------------------------------------|:--------------------------------------------------------------------------|
| `$this->assertMailHasHeader($header, $mail);`           | `$header` string<br/>`$mail` AssertableMessage, Email                     |
| `$this->assertMailMissingHeader($header, $mail);`       | `$header` string<br/>`$mail` AssertableMessage, Email                     |
| `$this->assertMailHeaderIs($header, $value, $mail);`    | `$header` string<br/>`$value` string<br/>`$mail` AssertableMessage, Email |
| `$this->assertMailHeaderIsNot($header, $value, $mail);` | `$header` string<br/>`$value` string<br/>`$mail` AssertableMessage, Email |

| Priority Assertions                               | Parameters                                           |
|:--------------------------------------------------|:-----------------------------------------------------|
| `$this->assertMailPriority($priority, $mail);`    | `$priority` int<br/>`$mail` AssertableMessage, Email |
| `$this->assertMailNotPriority($priority, $mail);` | `$priority` int<br/>`$mail` AssertableMessage, Email |
| `$this->assertMailPriorityIsHighest($mail);`      | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityNotHighest($mail);`     | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityIsHigh($mail);`         | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityNotHigh($mail);`        | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityIsNormal($mail);`       | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityNotNormal($mail);`      | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityIsLow($mail);`          | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityNotLow($mail);`         | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityIsLowest($mail);`       | `$mail` AssertableMessage, Email                     |
| `$this->assertMailPriorityIsLowest($mail);`       | `$mail` AssertableMessage, Email                     |

You should use each item of the `interceptedMail()` collection as the mail object for all assertions.

If you are injecting your own headers or need access to other headers in the email, use this assertion to verify they exist and are set properly. These assertions require the header name and the compiled email.

### Other assertions

Since `$this->interceptedMail()` returns a collection of `AssertableMessage` objects. You are free to dissect and look into those objects using any methods available to Symfony's Email API. Head over to the [Symfony Email Docs](https://symfony.com/doc/current/mailer.html) for more detailed info.

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

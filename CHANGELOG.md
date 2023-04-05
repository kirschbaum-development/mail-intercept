# Changelog

All notable changes to `mail-intercept` will be documented in this file

## 0.4.0 - 2023-04-05

- Added Laravel 10 support. Thank you [@cstriuli](https://github.com/cstriuli).
- Added PHP 8.2 test runners.

## 0.3.2 - 2022-06-14

- Fixed bug allowing email body to be asserted properly whether it is HTML or text. Thanks [@therobfonz](https://github.com/therobfonz).

## 0.3.1 - 2022-05-20

- Better type-hinting for `AssertableMessage` class in assertions. Thank you [@amsoel](https://github.com/amsoell).

## 0.3.0 - 2022-03-08

- Upgraded for Laravel 9
- New fluent syntax for making assertions directly on each message.
- Added new assertions methods:
  - `assertMailHasPlainContent`
  - `assertMailDoesNotHavePlainContent`
  - `assertMailHasHtmlContent`
  - `assertMailDoesNotHaveHtmlContent`
  - `assertMailIsAlternative`
  - `assertMailIsNotAlternative`
  - `assertMailIsMixed`
  - `assertMailIsNotMixed`
  - `assertMailPriority`
  - `assertMailNotPriority`
  - `assertMailPriorityIsHighest`
  - `assertMailPriorityNotHighest`
  - `assertMailPriorityIsHigh`
  - `assertMailPriorityNotHigh`
  - `assertMailPriorityIsNormal`
  - `assertMailPriorityNotNormal`
  - `assertMailPriorityIsLow`
  - `assertMailPriorityNotLow`
  - `assertMailPriorityIsLowest`
  - `assertMailPriorityNotLowest`
  - `assertMailReturnPath`
  - `assertMailNotReturnPath`

## 0.2.2 - 2020-03-11

- Added coverage for string assertion deprecations if using PHPUnit < 8.0

## 0.2.1 - 2020-03-11

- Fixed composer install command

## 0.2.0 - 2020-02-06

- Added new assertions for sender, cc, bcc, content type, and reply to
- Refactored to, from, and subject to use different getters
- Update readme to include new assertions

## 0.1.0 - 2019-12-06

- Initial release

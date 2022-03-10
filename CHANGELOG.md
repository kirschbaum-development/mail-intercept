# Changelog

All notable changes to `mail-intercept` will be documented in this file

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

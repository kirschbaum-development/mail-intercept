<?php

namespace KirschbaumDevelopment\MailIntercept;

use Illuminate\Support\Str;
use PHPUnit\Framework\Assert;
use Symfony\Component\Mime\Email;
use Illuminate\Support\Traits\ForwardsCalls;

/**
 * @method assertBcc(array|string $expected)
 * @method assertNotBcc(array|string $expected)
 * @method assertCc(array|string $expected)
 * @method assertNotCc(array|string $expected)
 * @method assertBodyContainsString(string $needle)
 * @method assertBodyNotContainsString(string $needle)
 * @method assertIsPlain
 * @method assertIsNotPlain
 * @method assertHasPlainContent
 * @method assertDoesNotHavePlainContent
 * @method assertIsHtml
 * @method assertIsNotHtml
 * @method assertHasHtmlContent
 * @method assertDoesNotHaveHtmlContent
 * @method assertIsAlternative
 * @method assertIsNotAlternative
 * @method assertIsMixed
 * @method assertIsNotMixed
 * @method assertSentFrom(array|string $expected)
 * @method assertNotSentFrom(array|string $expected)
 * @method assertPriority(int $priority)
 * @method assertNotPriority(int $priority)
 * @method assertPriorityIsHighest
 * @method assertPriorityNotHighest
 * @method assertPriorityIsHigh
 * @method assertPriorityNotHigh
 * @method assertPriorityIsNormal
 * @method assertPriorityNotNormal
 * @method assertPriorityIsLow
 * @method assertPriorityNotLow
 * @method assertPriorityIsLowest
 * @method assertPriorityNotLowest
 * @method assertRepliesTo(array|string $expected)
 * @method assertNotRepliesTo(array|string $expected)
 * @method assertReturnPath(array|string $expected)
 * @method assertNotReturnPath(array|string $expected)
 * @method assertSender(array|string $expected)
 * @method assertNotSender(array|string $expected)
 * @method assertSubject(array|string $expected)
 * @method assertNotSubject(array|string $expected)
 * @method assertSentTo(array|string $expected)
 * @method assertNotSentTo(array|string $expected)
 * @method assertHasHeader(string $expected)
 * @method assertMissingHeader(string $expected)
 * @method assertHeaderIs(string $expected, string $expectedValue)
 * @method assertHeaderIsNot(string $expected, string $expectedValue)
 */
class AssertableMessage extends Assert
{
    use ForwardsCalls;
    use WithMailInterceptor;

    /**
     * The Symfony SentMessage instance.
     *
     * @var Email
     */
    protected Email $email;

    /**
     * Create a new SentMessage instance.
     *
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Dynamically pass missing methods to the Symfony instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        if (Str::startsWith($method, 'assert')) {
            $assertion = 'assertMail' . Str::after($method, 'assert');
            $parameters[] = $this->email;

            return $this->$assertion(...$parameters);
        }

        return $this->forwardCallTo($this->email, $method, $parameters);
    }
}

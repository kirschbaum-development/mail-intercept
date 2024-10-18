<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class PriorityAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailPriority
    |--------------------------------------------------------------------------
    */

    public function testMailPrioritySingleEmail()
    {
        $priority = mt_rand(1, 5);

        $mail = (new Email())->priority($priority);

        $this->assertMailPriority($priority, $mail);
    }

    public function testMailPrioritySingleEmailViaAssertableMessage()
    {
        $priority = mt_rand(1, 5);

        $mail = new AssertableMessage(
            (new Email())->priority($priority)
        );

        $this->assertMailPriority($priority, $mail);
    }

    public function testMailPriorityThrowsProperExpectationFailedException()
    {
        $priorities = collect(range(1, 5))->shuffle();
        $actualPriority = $priorities->pop();
        $expectedPriority = $priorities->random();

        $mail = (new Email())->priority($actualPriority);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected priority was not [{$expectedPriority}].");

        $this->assertMailPriority($expectedPriority, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailNotPriority
    |--------------------------------------------------------------------------
    */

    public function testMailNotPrioritySingleEmail()
    {
        $priorities = collect(range(1, 5))->shuffle();
        $actualPriority = $priorities->pop();
        $expectedPriority = $priorities->random();

        $mail = (new Email())->priority($actualPriority);

        $this->assertMailNotPriority($expectedPriority, $mail);
    }

    public function testMailNotPrioritySingleEmailViaAssertableMessage()
    {
        $priorities = collect(range(1, 5))->shuffle();
        $actualPriority = $priorities->pop();
        $expectedPriority = $priorities->random();

        $mail = new AssertableMessage(
            (new Email())->priority($actualPriority)
        );

        $this->assertMailNotPriority($expectedPriority, $mail);
    }

    public function testMailNotPriorityThrowsProperExpectationFailedException()
    {
        $priority = mt_rand(1, 5);

        $mail = (new Email())->priority($priority);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected priority was [{$priority}].");

        $this->assertMailNotPriority($priority, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityIsHighest
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityHighest()
    {
        $mail = (new Email())->priority(Email::PRIORITY_HIGHEST);

        $this->assertMailPriorityIsHighest($mail);
    }

    public function testMailPriorityHighestViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGHEST)
        );

        $this->assertMailPriorityIsHighest($mail);
    }

    public function testMailPriorityHighestThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [highest].');

        $this->assertMailPriorityIsHighest($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityNotHighest
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNotHighest()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->assertMailPriorityNotHighest($mail);
    }

    public function testMailPriorityNotHighestViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->assertMailPriorityNotHighest($mail);
    }

    public function testMailPriorityNotHighestThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_HIGHEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [highest].');

        $this->assertMailPriorityNotHighest($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityIsHigh
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityHigh()
    {
        $mail = (new Email())->priority(Email::PRIORITY_HIGH);

        $this->assertMailPriorityIsHigh($mail);
    }

    public function testMailPriorityHighViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGH)
        );

        $this->assertMailPriorityIsHigh($mail);
    }

    public function testMailPriorityHighThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [high].');

        $this->assertMailPriorityIsHigh($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityNotHigh
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNotHigh()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->assertMailPriorityNotHigh($mail);
    }

    public function testMailPriorityNotHighViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->assertMailPriorityNotHigh($mail);
    }

    public function testMailPriorityNotHighThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_HIGH);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [high].');

        $this->assertMailPriorityNotHigh($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityIsNormal
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNormal()
    {
        $mail = (new Email())->priority(Email::PRIORITY_NORMAL);

        $this->assertMailPriorityIsNormal($mail);
    }

    public function testMailPriorityNormalViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_NORMAL)
        );

        $this->assertMailPriorityIsNormal($mail);
    }

    public function testMailPriorityNormalThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [normal].');

        $this->assertMailPriorityIsNormal($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityNotNormal
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNotNormal()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->assertMailPriorityNotNormal($mail);
    }

    public function testMailPriorityNotNormalViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->assertMailPriorityNotNormal($mail);
    }

    public function testMailPriorityNotNormalThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_NORMAL);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [normal].');

        $this->assertMailPriorityNotNormal($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityIsLow
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityLow()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOW);

        $this->assertMailPriorityIsLow($mail);
    }

    public function testMailPriorityLowViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $this->assertMailPriorityIsLow($mail);
    }

    public function testMailPriorityLowThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [low].');

        $this->assertMailPriorityIsLow($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityNotLow
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNotLow()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->assertMailPriorityNotLow($mail);
    }

    public function testMailPriorityNotLowViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->assertMailPriorityNotLow($mail);
    }

    public function testMailPriorityNotLowThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOW);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [low].');

        $this->assertMailPriorityNotLow($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityIsLowest
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityLowest()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->assertMailPriorityIsLowest($mail);
    }

    public function testMailPriorityLowestViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->assertMailPriorityIsLowest($mail);
    }

    public function testMailPriorityLowestThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOW);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [lowest].');

        $this->assertMailPriorityIsLowest($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailPriorityNotLowest
    |--------------------------------------------------------------------------
    */

    public function testMailPriorityNotLowest()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOW);

        $this->assertMailPriorityNotLowest($mail);
    }

    public function testMailPriorityNotLowestViaAssertableMessage()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $this->assertMailPriorityNotLowest($mail);
    }

    public function testMailPriorityNotLowestThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->priority(Email::PRIORITY_LOWEST);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [lowest].');

        $this->assertMailPriorityNotLowest($mail);
    }
}

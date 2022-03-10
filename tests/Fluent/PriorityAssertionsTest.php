<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class PriorityAssertionsTest extends TestCase
{
    public function testMailPrioritySingleEmail()
    {
        $priority = mt_rand(1, 5);

        $mail = new AssertableMessage(
            (new Email())->priority($priority)
        );

        $mail->assertPriority($priority);
    }

    public function testMailPriorityThrowsProperExpectationFailedException()
    {
        $priorities = collect(range(1, 5))->shuffle();
        $actualPriority = $priorities->pop();
        $expectedPriority = $priorities->random();

        $mail = new AssertableMessage(
            (new Email())->priority($actualPriority)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected priority was not [{$expectedPriority}].");

        $mail->assertPriority($expectedPriority);
    }

    public function testMailNotPrioritySingleEmail()
    {
        $priorities = collect(range(1, 5))->shuffle();
        $actualPriority = $priorities->pop();
        $expectedPriority = $priorities->random();

        $mail = new AssertableMessage(
            (new Email())->priority($actualPriority)
        );

        $mail->assertNotPriority($expectedPriority);
    }

    public function testMailNotPriorityThrowsProperExpectationFailedException()
    {
        $priority = mt_rand(1, 5);

        $mail = new AssertableMessage(
            (new Email())->priority($priority)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected priority was [{$priority}].");

        $mail->assertNotPriority($priority);
    }

    public function testMailPriorityHighest()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGHEST)
        );

        $mail->assertPriorityIsHighest();
    }

    public function testMailPriorityHighestThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [highest].');

        $mail->assertPriorityIsHighest();
    }

    public function testMailPriorityNotHighest()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $mail->assertPriorityNotHighest();
    }

    public function testMailPriorityNotHighestThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGHEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [highest].');

        $mail->assertPriorityNotHighest();
    }

    public function testMailPriorityHigh()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGH)
        );

        $mail->assertPriorityIsHigh();
    }

    public function testMailPriorityHighThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [high].');

        $mail->assertPriorityIsHigh();
    }

    public function testMailPriorityNotHigh()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $mail->assertPriorityNotHigh();
    }

    public function testMailPriorityNotHighThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_HIGH)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [high].');

        $mail->assertPriorityNotHigh();
    }

    public function testMailPriorityNormal()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_NORMAL)
        );

        $mail->assertPriorityIsNormal();
    }

    public function testMailPriorityNormalThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [normal].');

        $mail->assertPriorityIsNormal();
    }

    public function testMailPriorityNotNormal()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $mail->assertPriorityNotNormal();
    }

    public function testMailPriorityNotNormalThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_NORMAL)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [normal].');

        $mail->assertPriorityNotNormal();
    }

    public function testMailPriorityLow()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $mail->assertPriorityIsLow();
    }

    public function testMailPriorityLowThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [low].');

        $mail->assertPriorityIsLow();
    }

    public function testMailPriorityNotLow()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $mail->assertPriorityNotLow();
    }

    public function testMailPriorityNotLowThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [low].');

        $mail->assertPriorityNotLow();
    }

    public function testMailPriorityLowest()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $mail->assertPriorityIsLowest();
    }

    public function testMailPriorityLowestThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was not [lowest].');

        $mail->assertPriorityIsLowest();
    }

    public function testMailPriorityNotLowest()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOW)
        );

        $mail->assertPriorityNotLowest();
    }

    public function testMailPriorityNotLowestThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->priority(Email::PRIORITY_LOWEST)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('The expected priority was [lowest].');

        $mail->assertPriorityNotLowest();
    }
}

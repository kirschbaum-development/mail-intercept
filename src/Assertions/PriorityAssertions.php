<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use Symfony\Component\Mime\Email;

trait PriorityAssertions
{
    /**
     * Assert mail has priority.
     */
    public function assertMailPriority(int $expected, AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getPriority(),
            "The expected priority was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have priority.
     */
    public function assertMailNotPriority(int $expected, AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getPriority(),
            "The expected priority was [{$expected}]."
        );
    }

    /**
     * Assert mail has the highest priority.
     */
    public function assertMailPriorityIsHighest(AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_HIGHEST,
            $mail->getPriority(),
            'The expected priority was not [highest].'
        );
    }

    /**
     * Assert mail does not have the highest priority.
     */
    public function assertMailPriorityNotHighest(AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_HIGHEST,
            $mail->getPriority(),
            'The expected priority was [highest].'
        );
    }

    /**
     * Assert mail has high priority.
     */
    public function assertMailPriorityIsHigh(AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_HIGH,
            $mail->getPriority(),
            'The expected priority was not [high].'
        );
    }

    /**
     * Assert mail does not have high priority.
     */
    public function assertMailPriorityNotHigh(AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_HIGH,
            $mail->getPriority(),
            'The expected priority was [high].'
        );
    }

    /**
     * Assert mail has normal priority.
     */
    public function assertMailPriorityIsNormal(AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_NORMAL,
            $mail->getPriority(),
            'The expected priority was not [normal].'
        );
    }

    /**
     * Assert mail does not have normal priority.
     */
    public function assertMailPriorityNotNormal(AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_NORMAL,
            $mail->getPriority(),
            'The expected priority was [normal].'
        );
    }

    /**
     * Assert mail has low priority.
     */
    public function assertMailPriorityIsLow(AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_LOW,
            $mail->getPriority(),
            'The expected priority was not [low].'
        );
    }

    /**
     * Assert mail does not have low priority.
     */
    public function assertMailPriorityNotLow(AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_LOW,
            $mail->getPriority(),
            'The expected priority was [low].'
        );
    }

    /**
     * Assert mail has the lowest priority.
     */
    public function assertMailPriorityIsLowest(AssertableMessage|Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_LOWEST,
            $mail->getPriority(),
            'The expected priority was not [lowest].'
        );
    }

    /**
     * Assert mail does not have the lowest priority.
     */
    public function assertMailPriorityNotLowest(AssertableMessage|Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_LOWEST,
            $mail->getPriority(),
            'The expected priority was [lowest].'
        );
    }
}

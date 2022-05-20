<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

trait PriorityAssertions
{
    /**
     * Assert mail has priority.
     *
     * @param int $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriority(int $expected, AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            $expected,
            $mail->getPriority(),
            "The expected priority was not [{$expected}]."
        );
    }

    /**
     * Assert mail does not have priority.
     *
     * @param int $expected
     * @param AssertableMessage|Email $mail
     */
    public function assertMailNotPriority(int $expected, AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            $expected,
            $mail->getPriority(),
            "The expected priority was [{$expected}]."
        );
    }

    /**
     * Assert mail has the highest priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityIsHighest(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_HIGHEST,
            $mail->getPriority(),
            'The expected priority was not [highest].'
        );
    }

    /**
     * Assert mail does not have the highest priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityNotHighest(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_HIGHEST,
            $mail->getPriority(),
            'The expected priority was [highest].'
        );
    }

    /**
     * Assert mail has high priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityIsHigh(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_HIGH,
            $mail->getPriority(),
            'The expected priority was not [high].'
        );
    }

    /**
     * Assert mail does not have high priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityNotHigh(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_HIGH,
            $mail->getPriority(),
            'The expected priority was [high].'
        );
    }

    /**
     * Assert mail has normal priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityIsNormal(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_NORMAL,
            $mail->getPriority(),
            'The expected priority was not [normal].'
        );
    }

    /**
     * Assert mail does not have normal priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityNotNormal(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_NORMAL,
            $mail->getPriority(),
            'The expected priority was [normal].'
        );
    }

    /**
     * Assert mail has low priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityIsLow(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_LOW,
            $mail->getPriority(),
            'The expected priority was not [low].'
        );
    }

    /**
     * Assert mail does not have low priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityNotLow(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_LOW,
            $mail->getPriority(),
            'The expected priority was [low].'
        );
    }

    /**
     * Assert mail has the lowest priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityIsLowest(AssertableMessage | Email $mail): void
    {
        $this->assertEquals(
            Email::PRIORITY_LOWEST,
            $mail->getPriority(),
            'The expected priority was not [lowest].'
        );
    }

    /**
     * Assert mail does not have the lowest priority.
     *
     * @param AssertableMessage|Email $mail
     */
    public function assertMailPriorityNotLowest(AssertableMessage | Email $mail): void
    {
        $this->assertNotEquals(
            Email::PRIORITY_LOWEST,
            $mail->getPriority(),
            'The expected priority was [lowest].'
        );
    }
}

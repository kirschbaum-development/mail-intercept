<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use Symfony\Component\Mime\Email;

trait PriorityAssertions
{
    /**
     * Assert mail has priority.
     *
     * @param int $expected
     * @param Email $mail
     */
    public function assertMailPriority(int $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailNotPriority(int $expected, Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityIsHighest(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityNotHighest(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityIsHigh(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityNotHigh(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityIsNormal(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityNotNormal(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityIsLow(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityNotLow(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityIsLowest(Email $mail)
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
     * @param Email $mail
     */
    public function assertMailPriorityNotLowest(Email $mail)
    {
        $this->assertNotEquals(
            Email::PRIORITY_LOWEST,
            $mail->getPriority(),
            'The expected priority was [lowest].'
        );
    }
}

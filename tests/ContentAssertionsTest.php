<?php

namespace Tests;

use Swift_Message;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\Assertions\ContentAssertions;

class ContentAssertionsTest extends TestCase
{
    use WithFaker;
    use ContentAssertions;

    public function testMailBodyContents()
    {
        $content = $this->faker->sentence;

        $mail = (new Swift_Message())->setBody($content);

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Swift_Message())->setBody($this->faker->unique()->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Swift_Message())->setBody($this->faker->unique()->sentence);

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;

        $mail = (new Swift_Message())->setBody($content);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $this->assertMailBodyNotContainsString($content, $mail);
    }
}

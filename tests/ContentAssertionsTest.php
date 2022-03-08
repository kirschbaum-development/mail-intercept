<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use PHPUnit\Framework\ExpectationFailedException;

class ContentAssertionsTest extends TestCase
{
    public function testMailBodyContentsAsText()
    {
        $content = $this->faker->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($content);

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyContentsAsTextThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->unique()->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyAsTextDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($this->faker->unique()->sentence);

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyAsTextDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->text($content);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyContentsAsHtml()
    {
        $content = $this->faker->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($content);

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyContentsAsHtmlThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($this->faker->unique()->sentence);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyAsHtmlDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($this->faker->unique()->sentence);

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyAsHtmlDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;

        $mail = (new Email())
            ->to($this->faker->email)
            ->from($this->faker->email)
            ->html($content);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyContentsAsAbstractPart()
    {
        $content = $this->faker->sentence;
        $textPart = new TextPart($content);

        $mail = (new Email())->setBody($textPart);

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyContentsAsAbstractPartThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;
        $textPart = new TextPart($this->faker->unique()->sentence);

        $mail = (new Email())->setBody($textPart);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $this->assertMailBodyContainsString($content, $mail);
    }

    public function testMailBodyAsAbstractPartDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;
        $textPart = new TextPart($this->faker->unique()->sentence);

        $mail = (new Email())->setBody($textPart);

        $this->assertMailBodyNotContainsString($content, $mail);
    }

    public function testMailBodyAsAbstractPartDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;
        $textPart = new TextPart($content);

        $mail = (new Email())->setBody($textPart);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $this->assertMailBodyNotContainsString($content, $mail);
    }
}

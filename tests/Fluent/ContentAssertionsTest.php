<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class ContentAssertionsTest extends TestCase
{
    public function testMailBodyContentsAsText()
    {
        $content = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($content)
        );

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyContentsAsTextThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->unique()->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyAsTextDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($this->faker->unique()->sentence)
        );

        $mail->assertBodyNotContainsString($content);
    }

    public function testMailBodyAsTextDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->text($content)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $mail->assertBodyNotContainsString($content);
    }

    public function testMailBodyContentsAsHtml()
    {
        $content = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($content)
        );

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyContentsAsHtmlThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($this->faker->unique()->sentence)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyAsHtmlDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($this->faker->unique()->sentence)
        );

        $mail->assertBodyNotContainsString($content);
    }

    public function testMailBodyAsHtmlDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;

        $mail = new AssertableMessage(
            (new Email())
                ->to($this->faker->email)
                ->from($this->faker->email)
                ->html($content)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $mail->assertBodyNotContainsString($content);
    }

    public function testMailBodyContentsAsAbstractPart()
    {
        $content = $this->faker->sentence;
        $textPart = new TextPart($content);

        $mail = new AssertableMessage(
            (new Email())->setBody($textPart)
        );

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyContentsAsAbstractPartThrowsProperExpectationFailedException()
    {
        $content = $this->faker->unique()->sentence;
        $textPart = new TextPart($this->faker->unique()->sentence);

        $mail = new AssertableMessage(
            (new Email())->setBody($textPart)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was not found in the body.");

        $mail->assertBodyContainsString($content);
    }

    public function testMailBodyAsAbstractPartDoesNotHaveContents()
    {
        $content = $this->faker->unique()->sentence;
        $textPart = new TextPart($this->faker->unique()->sentence);

        $mail = new AssertableMessage(
            (new Email())->setBody($textPart)
        );

        $mail->assertBodyNotContainsString($content);
    }

    public function testMailBodyAsAbstractPartDoesNotHaveContentsThrowsProperExpectationFailedException()
    {
        $content = $this->faker->sentence;
        $textPart = new TextPart($content);

        $mail = new AssertableMessage(
            (new Email())->setBody($textPart)
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$content}] string was found in the body.");

        $mail->assertBodyNotContainsString($content);
    }
}

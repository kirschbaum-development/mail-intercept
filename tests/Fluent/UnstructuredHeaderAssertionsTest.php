<?php

namespace Tests\Fluent;

use Tests\TestCase;
use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;
use KirschbaumDevelopment\MailIntercept\AssertableMessage;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    public function testMailHasHeader()
    {
        $header = $this->faker->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $mail = new AssertableMessage($mail);

        $mail->assertHasHeader($header);
    }

    public function testMailHasHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->unique()->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $mail = new AssertableMessage($mail);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did not exist.");

        $mail->assertHasHeader($header);
    }

    public function testMailMissingHeader()
    {
        $header = $this->faker->unique()->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $mail = new AssertableMessage($mail);

        $mail->assertMissingHeader($header);
    }

    public function testMailMissingHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $mail = new AssertableMessage($mail);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did exist.");

        $mail->assertMissingHeader($header);
    }

    public function testMailHeaderIs()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $value);

        $mail = new AssertableMessage($mail);

        $mail->assertHeaderIs($header, $value);
    }

    public function testMailHeaderIsThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $mail = new AssertableMessage($mail);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was not set to [{$value}].");

        $mail->assertHeaderIs($header, $value);
    }

    public function testMailHeaderIsNot()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $mail = new AssertableMessage($mail);

        $mail->assertHeaderIsNot($header, $value);
    }

    public function testMailHeaderIsNotThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $value);

        $mail = new AssertableMessage($mail);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was set to [{$value}].");

        $mail->assertHeaderIsNot($header, $value);
    }
}

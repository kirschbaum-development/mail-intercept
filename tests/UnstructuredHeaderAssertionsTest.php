<?php

namespace Tests;

use Symfony\Component\Mime\Email;
use PHPUnit\Framework\ExpectationFailedException;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    public function testMailHasHeader()
    {
        $header = $this->faker->slug;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $this->assertMailHasHeader($header, $mail);
    }

    public function testMailHasHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->unique()->slug;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did not exist.");

        $this->assertMailHasHeader($header, $mail);
    }

    public function testMailMissingHeader()
    {
        $header = $this->faker->unique()->slug;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $this->assertMailMissingHeader($header, $mail);
    }

    public function testMailMissingHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did exist.");

        $this->assertMailMissingHeader($header, $mail);
    }

    public function testMailHeaderIs()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $value);

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    public function testMailHeaderIsThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was not set to [{$value}].");

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    public function testMailHeaderIsNot()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }

    public function testMailHeaderIsNotThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = (new Email());
        $mail->getHeaders()->addTextHeader($header, $value);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was set to [{$value}].");

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }
}

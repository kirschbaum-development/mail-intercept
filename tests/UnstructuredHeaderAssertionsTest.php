<?php

namespace Tests;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;

class UnstructuredHeaderAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailHasHeader
    |--------------------------------------------------------------------------
    */

    public function testMailHasHeader()
    {
        $header = $this->faker->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $this->assertMailHasHeader($header, $mail);
    }

    public function testMailHasHeaderViaAssertableMessage()
    {
        $header = $this->faker->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);
        $mail = new AssertableMessage($mail);

        $this->assertMailHasHeader($header, $mail);
    }

    public function testMailHasHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->unique()->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did not exist.");

        $this->assertMailHasHeader($header, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailMissingHeader
    |--------------------------------------------------------------------------
    */

    public function testMailMissingHeader()
    {
        $header = $this->faker->unique()->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);

        $this->assertMailMissingHeader($header, $mail);
    }

    public function testMailMissingHeaderViaAssertableMessage()
    {
        $header = $this->faker->unique()->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($this->faker->unique()->slug, $this->faker->word);
        $mail = new AssertableMessage($mail);

        $this->assertMailMissingHeader($header, $mail);
    }

    public function testMailMissingHeaderThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] header did exist.");

        $this->assertMailMissingHeader($header, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailHeaderIs
    |--------------------------------------------------------------------------
    */

    public function testMailHeaderIs()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $value);

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    public function testMailHeaderIsViaAssertableMessage()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $value);
        $mail = new AssertableMessage($mail);

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    public function testMailHeaderIsThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was not set to [{$value}].");

        $this->assertMailHeaderIs($header, $value, $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailHeaderIsNot
    |--------------------------------------------------------------------------
    */

    public function testMailHeaderIsNot()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }

    public function testMailHeaderIsNotViaAssertableMessage()
    {
        $header = $this->faker->slug;
        $value = $this->faker->unique()->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $this->faker->unique()->word);
        $mail = new AssertableMessage($mail);

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }

    public function testMailHeaderIsNotThrowsProperExpectationFailedException()
    {
        $header = $this->faker->slug;
        $value = $this->faker->word;

        $mail = new Email();
        $mail->getHeaders()->addTextHeader($header, $value);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage("The expected [{$header}] was set to [{$value}].");

        $this->assertMailHeaderIsNot($header, $value, $mail);
    }
}

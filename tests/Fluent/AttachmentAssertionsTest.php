<?php

namespace Tests\Fluent;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
use Tests\TestCase;

class AttachmentAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailHasAttachments
    |--------------------------------------------------------------------------
    */

    public function testMailHasAttachments()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))
        );

        $mail->assertHasAttachments($mail);
    }

    public function testMailHasAttachmentsThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected attachments.');

        $mail->assertHasAttachments($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailMissingAttachments
    |--------------------------------------------------------------------------
    */

    public function testMailMissingAttachments()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $mail->assertMissingAttachments($mail);
    }

    public function testMailMissingAttachmentsThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected attachments.');

        $mail->assertMissingAttachments($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailHasAttachment
    |--------------------------------------------------------------------------
    */

    public function testMailHasAttachment()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))
        );

        $mail->assertHasAttachment('f-18.jpg', $mail);
    }

    public function testMailHasAttachmentThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected attachment.');

        $mail->assertHasAttachment('f-18.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailMissingAttachment
    |--------------------------------------------------------------------------
    */

    public function testMailMissingAttachment()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $mail->assertMissingAttachment('f-18.jpg', $mail);
    }

    public function testMailMissingAttachmentThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected attachment.');

        $mail->assertMissingAttachment('f-18.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailHasEmbeddedImages
    |--------------------------------------------------------------------------
    */

    public function testMailHasEmbeddedImages()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline())
        );

        $mail->assertHasEmbeddedImages($mail);
    }

    public function testMailHasEmbeddedImagesThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing embedded images.');

        $mail->assertHasEmbeddedImages($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailMissingEmbeddedImages
    |--------------------------------------------------------------------------
    */

    public function testMailMissingEmbeddedImages()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $mail->assertMissingEmbeddedImages($mail);
    }

    public function testMailMissingEmbeddedImagesThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline())
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has embedded images.');

        $mail->assertMissingEmbeddedImages($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailHasEmbeddedImage
    |--------------------------------------------------------------------------
    */

    public function testMailHasEmbeddedImage()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline())
        );

        $mail->assertHasEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected embedded image.');

        $mail->assertHasEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageButCheckingForWrongImageThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected embedded image.');

        $mail->assertHasEmbeddedImage('f-22.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailMissingEmbeddedImage
    |--------------------------------------------------------------------------
    */

    public function testMailMissingEmbeddedImage()
    {
        $mail = new AssertableMessage(
            new Email()
        );

        $mail->assertMissingEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailMissingEmbeddedImageThrowsProperExpectationFailedException()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline())
        );

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected embedded image.');

        $mail->assertMissingEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageButCheckingForDifferentImage()
    {
        $mail = new AssertableMessage(
            (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline())
        );

        $mail->assertMissingEmbeddedImage('f-22.jpg', $mail);
    }
}

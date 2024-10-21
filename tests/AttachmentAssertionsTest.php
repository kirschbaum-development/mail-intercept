<?php

namespace Tests;

use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

class AttachmentAssertionsTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | assertMailHasAttachments
    |--------------------------------------------------------------------------
    */

    public function testMailHasAttachments()
    {
        $mail = (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')));

        $this->assertMailHasAttachments($mail);
    }

    public function testMailHasAttachmentsThrowsProperExpectationFailedException()
    {
        $mail = (new Email());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected attachments.');

        $this->assertMailHasAttachments($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailMissingAttachments
    |--------------------------------------------------------------------------
    */

    public function testMailMissingAttachments()
    {
        $mail = (new Email());

        $this->assertMailMissingAttachments($mail);
    }

    public function testMailMissingAttachmentsThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected attachments.');

        $this->assertMailMissingAttachments($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailHasAttachment
    |--------------------------------------------------------------------------
    */

    public function testMailHasAttachment()
    {
        $mail = (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')));

        $this->assertMailHasAttachment('f-18.jpg', $mail);
    }

    public function testMailHasAttachmentThrowsProperExpectationFailedException()
    {
        $mail = (new Email());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected attachment.');

        $this->assertMailHasAttachment('f-18.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailMissingAttachment
    |--------------------------------------------------------------------------
    */

    public function testMailMissingAttachment()
    {
        $mail = (new Email());

        $this->assertMailMissingAttachment('f-18.jpg', $mail);
    }

    public function testMailMissingAttachmentThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->addPart(new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected attachment.');

        $this->assertMailMissingAttachment('f-18.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailHasEmbeddedImages
    |--------------------------------------------------------------------------
    */

    public function testMailHasEmbeddedImages()
    {
        $mail = (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline());

        $this->assertMailHasEmbeddedImages($mail);
    }

    public function testMailHasEmbeddedImagesThrowsProperExpectationFailedException()
    {
        $mail = (new Email());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing embedded images.');

        $this->assertMailHasEmbeddedImages($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | assertMailMissingEmbeddedImages
    |--------------------------------------------------------------------------
    */

    public function testMailMissingEmbeddedImages()
    {
        $mail = (new Email());

        $this->assertMailMissingEmbeddedImages($mail);
    }

    public function testMailMissingEmbeddedImagesThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has embedded images.');

        $this->assertMailMissingEmbeddedImages($mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailHasEmbeddedImage
    |--------------------------------------------------------------------------
    */

    public function testMailHasEmbeddedImage()
    {
        $mail = (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline());

        $this->assertMailHasEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageThrowsProperExpectationFailedException()
    {
        $mail = (new Email());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected embedded image.');

        $this->assertMailHasEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageButCheckingForWrongImageThrowsProperExpectationFailedException()
    {
        $mail = (new Email());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail missing expected embedded image.');

        $this->assertMailHasEmbeddedImage('f-22.jpg', $mail);
    }

    /*
    |--------------------------------------------------------------------------
    | testMailMissingEmbeddedImage
    |--------------------------------------------------------------------------
    */

    public function testMailMissingEmbeddedImage()
    {
        $mail = (new Email());

        $this->assertMailMissingEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailMissingEmbeddedImageThrowsProperExpectationFailedException()
    {
        $mail = (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline());

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage('Mail has expected embedded image.');

        $this->assertMailMissingEmbeddedImage('f-18.jpg', $mail);
    }

    public function testMailHasEmbeddedImageButCheckingForDifferentImage()
    {
        $mail = (new Email())->addPart((new DataPart(new File(__DIR__ . '/../Fixtures/f-18.jpg')))->asInline());

        $this->assertMailMissingEmbeddedImage('f-22.jpg', $mail);
    }
}

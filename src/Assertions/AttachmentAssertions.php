<?php

namespace KirschbaumDevelopment\MailIntercept\Assertions;

use KirschbaumDevelopment\MailIntercept\AssertableMessage;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

trait AttachmentAssertions
{
    /*
    |--------------------------------------------------------------------------
    | File Attachments
    |--------------------------------------------------------------------------
    */

    /**
     * Assert mail has attachments.
     */
    public function assertMailHasAttachments(AssertableMessage|Email $mail): void
    {
        $this->assertNotEmpty(
            $mail->getAttachments(),
            'Mail missing expected attachments.'
        );
    }

    /**
     * Assert mail missing attachments.
     */
    public function assertMailMissingAttachments(AssertableMessage|Email $mail): void
    {
        $this->assertEmpty(
            $mail->getAttachments(),
            'Mail has expected attachments.'
        );
    }

    /**
     * Assert mail has attachment.
     */
    public function assertMailHasAttachment(string $expected, AssertableMessage|Email $mail): void
    {
        $hasAttachment = collect($mail->getAttachments())
            ->contains(fn (DataPart $attachment) => $expected === $attachment->getFilename());

        $this->assertTrue(
            $hasAttachment,
            'Mail missing expected attachment.'
        );
    }

    /**
     * Assert mail missing attachment.
     */
    public function assertMailMissingAttachment(string $expected, AssertableMessage|Email $mail): void
    {
        $missingAttachment = ! collect($mail->getAttachments())
            ->contains(fn (DataPart $attachment) => $expected === $attachment->getFilename());

        $this->assertTrue(
            $missingAttachment,
            'Mail has expected attachment.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Embedded Images
    |--------------------------------------------------------------------------
    */

    /**
     * Assert mail has attachments.
     */
    public function assertMailHasEmbeddedImages(AssertableMessage|Email $mail): void
    {
        $hasEmbedded = collect($mail->getAttachments())
            ->contains(fn (DataPart $attachment) => $attachment->getDisposition() === 'inline');

        $this->assertTrue(
            $hasEmbedded,
            'Mail missing embedded images.'
        );
    }

    /**
     * Assert mail missing attachments.
     */
    public function assertMailMissingEmbeddedImages(AssertableMessage|Email $mail): void
    {
        $missingEmbedded = ! collect($mail->getAttachments())
            ->contains(fn (DataPart $attachment) => $attachment->getDisposition() === 'inline');

        $this->assertTrue(
            $missingEmbedded,
            'Mail has embedded images.'
        );
    }

    /**
     * Assert mail has attachment.
     */
    public function assertMailHasEmbeddedImage(string $expected, AssertableMessage|Email $mail): void
    {
        /**
         * @var DataPart|null $embed
         */
        $embed = collect($mail->getAttachments())
            ->firstWhere(fn (DataPart $attachment) => $expected === $attachment->getFilename());

        if ($embed) {
            $this->assertTrue(
                $embed->getDisposition() === 'inline',
                'Mail has expected attachment but is not embedded.'
            );

            return;
        }

        throw new ExpectationFailedException('Mail missing expected embedded image.');
    }

    /**
     * Assert mail missing attachment.
     */
    public function assertMailMissingEmbeddedImage(string $expected, AssertableMessage|Email $mail): void
    {
        /**
         * @var DataPart|null $embed
         */
        $embed = collect($mail->getAttachments())
            ->firstWhere(fn (DataPart $attachment) => $expected === $attachment->getFilename());

        if (! $embed) {
            $this->assertNull($embed);

            return;
        }

        $this->assertTrue(
            $embed->getDisposition() !== 'inline',
            'Mail has expected embedded image.'
        );
    }
}

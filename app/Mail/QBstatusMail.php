<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QBstatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $subject;
    public function __construct($details, $subject)
    {
        $this->details = $details;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.qbstatusmail',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}

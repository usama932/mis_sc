<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class updateprogressMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Activity Status Update',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.update_progressmail',
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
}

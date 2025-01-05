<?php

namespace App\Mail;

use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use function Laravel\Prompts\text;

class GuestEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $acceptUrl;
    private $declineUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($acceptUrl, $declineUrl)
    {
        $this->acceptUrl = $acceptUrl;
        $this->declineUrl = $declineUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Guest Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            with: [
                'acceptUrl' => $this->acceptUrl,
                'declineUrl' => $this->declineUrl,
            ],
            htmlString: '<h1>Przyjmij zaproszenie na wydarzenie</h1>'
            . '<p><a href="' . $this->acceptUrl . '">Akceptuj</a></p>'
            . '<p>lub</p>'
            . '<p><a href="' . $this->declineUrl . '">Odrzuć</a></p>',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

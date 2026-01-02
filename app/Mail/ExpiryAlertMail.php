<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ExpiryAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Collection $expired,
        public Collection $soon,
        public int $days
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pharmacy Expiry Alerts',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.expiry_alert',
            with: [
                'expired' => $this->expired,
                'soon' => $this->soon,
                'days' => $this->days,
                'expiredCount' => $this->expired->count(),
                'soonCount' => $this->soon->count(),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

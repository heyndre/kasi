<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class StudentAttendance extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $recipient;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        // $this->data['email'] = $recipient;
        // $this->recipient = $recipient;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Attendance ' . now()->format('d/m/Y H:i:s T'),
            // to: [$this->recipient],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.student-attendance',
            with: [
                'data' => $this->data
            ]
        );
    }

    public function headers(): Headers
    {
        return new Headers(
            references: [],
            text: [
                // 'Content-Type' => 'text/html',
                // 'Content-Transfer-Encoding' => 'quoted-printable',
            ],
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

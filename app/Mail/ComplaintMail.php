<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ComplaintMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $subject;
    private $is_admin = false;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
            $this->user = $user;
            $this->subject = "Just IN! Your Complaint has been sent";
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        return new Content(
            view: 'emails.complaint',
            with: [
                'name' => $this->user->first_name,
                'email' => $this->user->email
            ]
        );


    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

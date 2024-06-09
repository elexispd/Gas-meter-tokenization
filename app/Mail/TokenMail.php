<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TokenMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $details;
    private $token;
    // public function __construct(User $user, $details, $token)
    // {
    //     $this->user = $user; $this->details = $details; $this->token = $token;
    // }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Just IN! Token Payment Successful',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // return new Content(
        //     view: 'emails.token',
        //     with: [
        //         'name' => $this->user->first_name . " " . $this->user->last_name,
        //         'email' => $this->user->email,
        //         'token' => $this->token,
        //         'price' => $this->details->amount,
        //         'quantity' => $this->details->quantity
        //     ]
        // );
         return new Content(
            view: 'emails.token',
            with: [
                'name' => "Promise Elexis",
                'email' => "promisedeco24@gmailcom",
                'token' => 342342342,
                'price' => 1200,
                'quantity' => 1
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

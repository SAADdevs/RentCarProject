<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewloginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mailmessage;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject)
    {
        $this->mailmessage = $message;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('saad.zkzk2020@gmail.com', 'Your Car Rental Website') // Set your email
                    ->subject($this->subject)
                    ->view('emails.newLoginNotification')
                    ->with([
                        'messageContent' => $this->mailmessage,
                    ]);
    }
}

<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EndingRentalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $rental;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($rental, $user)
    {
        $this->rental = $rental;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.EndingRentalNotification')
                    ->with([
                        'rental' => $this->rental,
                        'user' => $this->user,
                    ]);
    }
}

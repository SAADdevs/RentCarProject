<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PutingCarForRentingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $messageContent;
    public $subject;
    public $owner;

    /**
     * Create a new message instance.
     */
    public function __construct($car,$owner)
    {
        $this->owner = $owner;
        $this->car = $car;
        $this->messageContent =   $owner->name .'want to put his car for renting  : ' .$car->model;
        $this->subject = 'New Rental Request';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('saad.zkzk2020@gmail.com', 'Your Car Rental Website')
                    ->subject($this->subject)
                    ->text('emails.PutingCarForRentingNotification')
                    ->with([
                        'messageContent' => $this->messageContent,
                        'car' => $this->car,
                        'owner'=> $this->owner,
                    ]);
    }
}

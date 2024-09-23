<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $customer;
    public $messageContent;
    public $subject;
    public $owner;

    /**
     * Create a new message instance.
     */
    public function __construct($car, $customer,$owner)
    {
        $this->owner = $owner;
        $this->car = $car;
        $this->customer = $customer;
        $this->messageContent = "Customer " . $this->customer->name . " has requested to rent your car: " . $this->car->model;
        $this->subject = 'New Rental Request';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('saad.zkzk2020@gmail.com', 'Your Car Rental Website')
                    ->subject($this->subject)
                    ->text('emails.rentalRequestNotification') // Use a plain text view
                    ->with([
                        'messageContent' => $this->messageContent,
                        'car' => $this->car,
                        'customer' => $this->customer,
                        'owner'=> $this->owner,
                    ]);
    }
}

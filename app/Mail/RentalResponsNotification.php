<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalResponsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $customer;
    public $messageContent;
    public $subject;
    public $owner;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($car, $customer,$owner,$status)
    {
        $this->status = $status;
        $this->owner = $owner;
        $this->car = $car;
        $this->customer = $customer;
        $this->messageContent =  $status == 'approved' ? "Owner " . $this->owner->name . " has approved your car " . $this->car->model  : "Owner " . $this->owner->name . " has rejected your car " . $this->car->model;
        $this->subject = 'New Rental Respons';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('saadchabili20@gmail.com', 'Car Rental')
                    ->subject($this->subject)
                    ->text('emails.RentalResponsNotification')
                    ->with([
                        'messageContent' => $this->messageContent,
                        'car' => $this->car,
                        'customer' => $this->customer,
                        'owner'=> $this->owner,
                    ]);
    }
}

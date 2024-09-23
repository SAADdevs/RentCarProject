<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResponsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $car;
    public $messageContent;
    public $subject;
    public $owner;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($car,$owner,$status)
    {
        $this->status = $status;
        $this->owner = $owner;
        $this->car = $car;
        $this->messageContent =  $status == 'approved' ? "admin has approved your car , now it is availabel in market you can check it \n  model :" . $this->car->model  :  "admin has rejected your car , there something in your requirements in your car fix that and then you are welcom to request again \n  model : " . $this->car->model;
        $this->subject = 'New Rental Request';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('saad.zkzk2020@gmail.com', 'Car Rental')
                    ->subject($this->subject)
                    ->text('emails.AdminResponsNotification')
                    ->with([
                        'messageContent' => $this->messageContent,
                        'car' => $this->car,
                        'owner'=> $this->owner,
                    ]);
    }
}

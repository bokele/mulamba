<?php

namespace App\Mail;

use App\User;
use App\Order;
use App\Address;
use App\Car;
use App\CarModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveSeller extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;

    protected $owner;
    protected $customer;
    protected $car;
    protected $cacar_model;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order,  User $owner, User $customer, Car $car, CarModel $car_model)
    {
        $this->order = $order;
        $this->owner = $owner;
        $this->customer = $customer;
        $this->car = $car;
        $this->car_model = $car_model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.approveSeller', [

            'order' => $this->order,
            'owner' => $this->owner,
            'car' => $this->car,
            'customer' => $this->customer,
            'car_model' => $this->car_model,

        ]);
    }
}

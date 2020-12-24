<?php

namespace App\Mail;

use App\User;
use App\Order;
use App\Address;
use App\Car;
use App\CarModel;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     * The payment instance.
     *
     * @var Order
     * @var Address
     * @var User
     */
    protected $order;
    protected $address;
    protected $shipping;

    protected $owner;
    protected $customer;
    protected $car;
    protected $car_model;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, Address $address,  User $owner, User $customer, Car $car, CarModel $car_model)
    {
        $this->order = $order;
        $this->address = $address;
        // $this->shipping = $shipping;
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
        return $this->view('mail.order')
            ->with([
                'order' => $this->order,
                'address' => $this->address,
                'owner' => $this->owner,
                'car' => $this->car,
                'customer' => $this->customer,
                'car_model' => $this->car_model,
            ]);
    }
}

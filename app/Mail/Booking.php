<?php

namespace App\Mail;

use App\Car;
use App\User;
use App\Order;
use App\Address;
use App\CarModel;
use App\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Booking extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $pick_up;
    protected $drop_of;

    protected $owner;
    protected $customer;
    protected $car;
    protected $car_model;
    protected $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Order $order,
        Address $pick_up,
        Address $drop_of,
        User $owner,
        User $customer,
        Car $car,
        CarModel $car_model,
        Reservation $booking
    ) {
        $this->order = $order;
        $this->pick_up = $pick_up;
        $this->drop_of = $drop_of;

        $this->owner = $owner;
        $this->customer = $customer;
        $this->car = $car;
        $this->car_model = $car_model;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.booking_order')->with([
            'order' => $this->order,
            'pick_up' => $this->pick_up,
            'drop_of' => $this->drop_of,
            'owner' => $this->owner,
            'car' => $this->car,
            'customer' => $this->customer,
            'car_model' => $this->car_model,
            'booking' => $this->booking,
        ]);
    }
}

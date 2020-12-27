<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use App\Order;
use App\Address;
use App\Country;
use App\Message;
use App\CarModel;
use App\Mail\Booking;
use App\Reservation;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;

class ReservationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $payment;
    public function __construct()
    {
        $this->middleware('auth');
        $this->payment = new PaymentController();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $car_brand = CarModel::orderBy('brand', 'asc')->groupBy('brand', 'car_models.id')->get();
        $countries = Country::orderBy('name', 'asc')->get();

        $car_sold =  Car::where('cars.id', $id)
            ->join('users', 'users.id', '=', 'cars.id')
            ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

            ->select(
                'cars.*',
                'car_models.brand as brand',
                'car_models.model as model',
                'car_models.vehicle_type as vehicle_type',
                'car_models.year as year',
                'users.name as name',
                'users.email as email',
                'countries.name as country_name',
                'countries.id as country_id',
            )->firstOrFail();
        if ($user->type == 'user') {
            if (\Route::current()->getName() == "boutiques.car.booking") {

                return view('pages.car.booking', [
                    'car_sold' => $car_sold,
                    'car_id' => $id,
                    'car_brand' => $car_brand,
                    'countries' => $countries

                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'max_days' => ['required'],
            'pick_up_state_or_province' => ['required'],
            'pick_up_city' => ['required'],
            'drop_of_state_or_province' => ['required'],
            'drop_of_city' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);


        $order = new Order();
        $pick_up_address = new Address();
        $drop_of_address = new Address();

        $car = Car::findOrFail($request['car_id']);
        $pick_up_address->country_id = $request['country_id'];
        $pick_up_address->city = $request['pick_up_state_or_province'];
        $pick_up_address->state = $request['pick_up_city'];
        $pick_up_address->save();

        $drop_of_address->country_id = $request['country_id'];
        $drop_of_address->city = $request['drop_of_state_or_province'];
        $drop_of_address->state = $request['drop_of_city'];
        $drop_of_address->save();

        $latesOrder = Order::orderBy('created_at', 'DESC')->first();
        if ($latesOrder == "") {
            $code = date('ymd') . '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
        } else {
            $code = date('ymd') . '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
        }

        $order->code = $code;
        $order->customer_id = $user->id;
        $order->car_id = $request['car_id'];
        $order->country_id = $request['country_id'];
        $order->owner_id = $car->owner_id;
        $order->address_id = $pick_up_address->id;
        $order->status = "booking";
        $order->price = $car->price * 100;
        $order->propose_price =  (($car->price / 100) * $request['max_days']) * 100;
        $order->balance = 0;
        $order->save();

        $reservation = new Reservation();
        $reservation->pick_up_location_id = $pick_up_address->id;
        $reservation->drop_off_location_id = $drop_of_address->id;
        $reservation->customer_id = $user->id;
        $reservation->car_id = $request['car_id'];
        $reservation->order_id = $order->id;
        $reservation->start_date = $request['start_date'];
        $reservation->end_date = $request['end_date'];
        $reservation->days = $request['max_days'];
        $reservation->save();

        $messege = new Message();
        $messege->subjecte = "price Propose";
        $messege->message = "Booking your car For order ID:" . $order->code;
        $messege->from = $user->id;
        $messege->to = $car->owner_id;
        $messege->save();

        DB::table('message_order')->insert([
            'message_id' => $messege->id,
            'order_id' => $order->id,
        ]);
        $customer = User::findOrFail($user->id);
        $owner = User::findOrFail($car->owner_id);
        $pick_up_address = Address::findOrFail($pick_up_address->id);
        $drop_of_address = Address::findOrFail($drop_of_address->id);
        $car = Car::findOrFail($car->id);
        $car_model = CarModel::findOrFail($car->car_model_id);

        $booking['pick_up'] = $pick_up_address;
        $booking['drop_of'] = $drop_of_address;

        Mail::to($request->user())->send(new Booking($order,  $pick_up_address, $drop_of_address,  $owner,  $customer, $car, $car_model, $reservation));
        Mail::to($owner->email)->send(new Booking($order,  $pick_up_address, $drop_of_address,  $owner,  $customer, $car, $car_model, $reservation));
        // return redirect()->route('order.success');
        return redirect('/payment/booking/' . $order->id . '/booking');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function bookingOrderInfo($id, $type)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'paid') {
            return redirect('/finance-management/orders')->with('success', 'You already paid');
        } else {
            $price = $order->price;
            $propose_price = $order->propose_price;
            $car_sold = Car::where('cars.id', $order->car_id)
                ->join('users', 'users.id', '=', 'cars.id')
                ->join('addresses', 'cars.address_id', '=', 'addresses.id')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')

                ->select('cars.*', 'car_models.brand as brand', 'car_models.model as model', 'countries.name as country_name', 'users.name as owner')
                ->firstOrFail();

            $user = auth()->user();

            $user_id = $user->id;

            $countries = Country::orderBy('name', 'asc')->get();
            $address = Address::findOrFail($order->address_id);


            Stripe::setApiKey('sk_test_Bu4YfvdBhbITFzLhXbfGxDV300CE9nXAI0');

            $intents = PaymentIntent::create([
                'description' => 'Payment for  ' . $type,
                'amount' => $order->propose_price / 100,
                'currency' =>  'usd',
                "metadata" => [
                    "order_id" => $order->id,
                    "user_id" => $user->id,
                    "user_email" => $user->email,
                    "user_name" => $user->name,
                ],
                "receipt_email" => $user->email,
            ]);


            $client_secret = Arr::get($intents, 'client_secret');
            // dd($car_sold);

            return view('user.finance.payment-booking-form', [
                'countries' => $countries,
                'order_currency' => $order->currency,
                'price' => $price,
                'propose_price' => $propose_price,
                'client_secret' => $client_secret,
                'address' => $address,
                'car_sold' => $car_sold,
                'id' => $id,
                'type' => $type,
                'code' => $order->code,

            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}

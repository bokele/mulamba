<?php

namespace App\Http\Controllers;

use App\Order;
use App\Address;
use App\Car;
use App\Country;
use App\Payment;
use App\User;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAllPayment()
    {
        $user = Auth::user();

        if ($user->type == 'user') {
            $data = Payment::with(['order', 'owner'])
                ->where('payments.customer_id', $user->id);
            return DataTables::eloquent($data)
                // ->editColumn('price', function ($data) {

                //     return number_format($data->price / 100, 2);
                // })
                ->editColumn('reference_code', function ($data) {

                    return $data->ref_number;
                })
                ->editColumn('order_code', function ($data) {

                    return $data->order->code;
                })
                ->editColumn('owner', function ($data) {

                    return $data->owner->name . " " . $data->owner->email;
                })

                ->editColumn('currency', function ($data) {

                    return $data->currency;
                })
                ->editColumn('sold_price', function ($data) {

                    return number_format($data->sold_price / 100, 2);
                })
                ->editColumn('amount_paid', function ($data) {

                    return number_format($data->amount_paid / 100, 2);
                })


                ->editColumn('created_at', function ($data) {


                    return $data->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($data) {


                    return $data->updated_at->diffForHumans();
                })

                ->addColumn('status', function ($data) {

                    $status = "";

                    if ($data->status == 'fail') {
                        $status = '<span class="badge badge-warning p-1 text-capitalize"> ' . $data->status . '  </span>';
                    } elseif ($data->status == 'cancel') {
                        $status = '<span class="badge badge-danger p-1 text-capitalize">' . $data->status . '  </span>';
                    } elseif ($data->status == 'complete') {
                        $status = '<span class="badge badge-purple p-1 text-capitalize"> ' . $data->status . '   </span>';
                    }
                    return $status;
                })
                ->addColumn('actions', function ($data) {
                    $user = Auth::user();


                    $button = '';
                    $button .=
                        '
                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="show btn btn-purple btn-sm"
                          data-placement="top"
                          title="payment datail"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-eye blue"></i>
                        </button>
                       ';




                    return $button;
                })

                ->rawColumns(['type', 'status', 'actions'])
                ->toJson();
        }

        if ($user->type == 'seller') {

            $data = Payment::with(['order', 'owner', 'customer'])
                ->where('payments.owner_id', $user->id);
            // ->join('orders', 'orders.id', 'payments.order_id')
            // ->join('car_solds', 'orders.car_sold_id', 'car_solds.id')
            // ->join('cars', 'cars.id', 'car_solds.car_id')
            // ->join('addresses', 'cars.address_id', '=', 'addresses.id')
            // ->join('countries', 'addresses.country_id', '=', 'countries.id')
            // ->join('car_models', 'cars.car_model_id', '=', 'car_models.id')
            // ->select('payments.*', 'car_models.brand as brand', 'car_models.model as model', 'countries.name as country_name')
            return DataTables::eloquent($data)
                // ->editColumn('price', function ($data) {

                //     return number_format($data->price / 100, 2);
                // })
                ->editColumn('reference_code', function ($data) {

                    return $data->ref_number;
                })
                ->editColumn('order_code', function ($data) {

                    return $data->order->code;
                })
                ->editColumn('owner', function ($data) {

                    return $data->owner->name . " " . $data->owner->email;
                })
                ->editColumn('customer', function ($data) {

                    return $data->customer->name . " " . $data->customer->email;
                })
                ->editColumn('currency', function ($data) {

                    return $data->currency;
                })
                ->editColumn('sold_price', function ($data) {

                    return number_format($data->sold_price / 100, 2);
                })
                ->editColumn('amount_paid', function ($data) {

                    return number_format($data->amount_paid / 100, 2);
                })
                ->editColumn('payment_code', function ($data) {

                    return $data->payment_code;
                })

                ->editColumn('created_at', function ($data) {


                    return $data->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($data) {


                    return $data->updated_at->diffForHumans();
                })

                ->addColumn('status', function ($data) {
                    $status = "";
                    if ($data->status == 'fail') {
                        $status = '<span class="badge badge-warning p-1 text-capitalize"> ' . $data->status . '  </span>';
                    } elseif ($data->status == 'cancel') {
                        $status = '<span class="badge badge-danger p-1 text-capitalize">' . $data->status . '  </span>';
                    } elseif ($data->status == 'complete') {
                        $status = '<span class="badge badge-purple p-1 text-capitalize"> ' . $data->status . '   </span>';
                    }
                    return $status;
                })
                ->addColumn('actions', function ($data) {


                    $button = '
                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="show btn btn-purple btn-sm"
                          data-placement="top"
                          title="payment datail"
                          data-toggle="tooltip modal">
                          <i class="fa fa-eye blue"></i>
                        </button>';

                    return $button;
                })

                ->rawColumns(['status', 'actions'])
                ->toJson();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->type == 'user') {
            return view('user.finance.payment');
        }

        if ($user->type == 'seller') {
            return view('seller.finance.payment');
        }
    }
    public function getOrderInfoForPayment($id, $type)
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

            return view('user.finance.payment-form', [
                'countries' => $countries,
                'order_currency' => $order->currency,
                'price' => $price,
                'propose_price' => $propose_price,
                'client_secret' => $client_secret,
                'address' => $address,
                // 'address_shipping' => $address_shipping,
                'car_sold' => $car_sold,
                'id' => $id,
                'type' => $type,
                'code' => $order->code,

            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'paid') {
            return redirect('/finance-management/orders')->with('success', 'You already paid');
        } else {
            if (request()->ajax()) {
                if (\Route::current()->getName() == "payment.booking.payment.create") {
                    $validator =  Validator::make($request->all(), [
                        'phone_number' => ['numeric'],
                        'credit_card_name' => ['required'],

                    ]);
                } else {
                    $validator =  Validator::make($request->all(), [
                        'phone_number' => ['numeric'],
                        'shpping_country' => ['required'],
                        'shpping_full_address' => ['required'],
                        'shipping_city' => ['required'],
                        'shpping_state_or_province' => ['required'],
                        'credit_card_name' => ['required'],

                    ]);
                }

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()]);
                } else {
                    if (\Route::current()->getName() == "payment.booking.payment.create") {
                        $address_id = $request['address_id'];
                        $address = Address::FindorFail($address_id);
                        $user_auth = Auth::user();
                        $user = User::findOrFail($user_auth->id);
                        $user->mobile_number = $request['phone_number'];
                        $user->address_id = $address->id;

                        $user->update();
                    } else {
                        $address_id = $request['address_id'];
                        $address = Address::FindorFail($address_id);
                        $address_shipping = new Address();
                        $user_auth = Auth::user();
                        $user = User::findOrFail($user_auth->id);
                        //creating shipping appress
                        $address_shipping->country_id = $request['shpping_country'];
                        $address_shipping->full_address = $request['shpping_full_address'];
                        $address_shipping->city = $request['shipping_city'];
                        $address_shipping->state = $request['shpping_state_or_province'];
                        $address_shipping->street_name = $request['shpping_street_name'];
                        $address_shipping->home_number = $request['shpping_home_number'];
                        $address_shipping->home_number = $request['shpping_home_number'];
                        $address_shipping->save();
                        //update user information Telephone number added
                        $user->mobile_number = $request['phone_number'];
                        $user->address_id = $address->id;
                        $user->shipping_address = $address_shipping->id;
                        $user->update();
                        //update order status

                    }


                    return response()->json(['success' => 'ok']);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = auth()->user();
        $user_id = $user->id;


        $order = Order::findOrFail($id);
        if ($order->status == 'paid') {
            return redirect('/finance-management/orders')->with('success', 'You already paid');
        } else {

            $owner = "";
            $car = Car::findOrFail($order->car_id);
            $owner = $car->owner_id;



            $data = $request->json()->all();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->customer_id = $user_id;
            $payment->owner_id = $owner;
            $payment->ref_number = $data['paymentIntent']['currency'];
            $payment->currency = $data['paymentIntent']['currency'];
            $payment->amount_paid =  $data['paymentIntent']['amount'];
            $payment->sold_price =  $order->price;
            $payment->status = 'complete';
            $payment->confirm = false;
            $payment->method = $data['paymentIntent']['payment_method_types'][0];
            $payment->type = 'stripe';
            $payment->payment_method = $data['paymentIntent']['payment_method'];
            $payment->payment_code = $data['paymentIntent']['id'];
            $payment->payment_time = $data['paymentIntent']['created'];

            $payment->save();

            $order->status = 'paid';
            $order->update();

            return $data['paymentIntent'];
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();


        if ($user->type == 'seller') {
            $data = Payment::with(['order', 'owner', 'customer'])
                ->where('id', $id)
                ->where('owner_id', $user->id)
                ->firstOrFail();
        }


        if ($user->type == 'user') {
            $data = Payment::with(['order', 'owner', 'customer'])
                ->where('id', $id)
                ->where('customer_id', $user->id)
                ->firstOrFail();
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Car;
use App\Order;
use App\Address;
use App\Country;
use App\Message;
use App\CarModel;
use App\GearBoxType;
use App\Mail\Approve;
use App\Mail\ApproveSeller;
use App\Mail\OrderShipped;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $gear_boxes = GearBoxType::orderBy('name', 'asc')->get();
        $car_model = CarModel::orderBy('model', 'asc')->groupBy('model', 'car_models.id')->limit(30)->get();
        $car_brand = CarModel::orderBy('brand', 'asc')->groupBy('brand', 'car_models.id')->limit(30)->get();
        $car_types = CarModel::select('vehicle_type', 'car_models.id')->groupBy('vehicle_type', 'id')->limit(30)->orderBy('vehicle_type', 'asc')->get();


        $user = Auth::user();
        if ($user->type == 'user') {
            return view('user.finance.order', [
                'countries' => $countries,
                'gear_boxes' => $gear_boxes,
                'car_model' => $car_model,
                'car_brand' => $car_brand,
                'car_types' => $car_types,
            ]);
        }
        if ($user->type == 'seller') {
            return view('seller.finance.order',  [
                'countries' => $countries,
                'gear_boxes' => $gear_boxes,
                'car_model' => $car_model,
                'car_brand' => $car_brand,
                'car_types' => $car_types,
            ]);
        }
    }

    public function getAllOrder()
    {
        $user = Auth::user();

        if ($user->type == 'user') {
            $data = Order::where('customer_id', $user->id)->orderBy('id', 'desc');
        }
        if ($user->type == 'seller') {
            $data = Order::where('owner_id', $user->id)->orderBy('id', 'desc');
        }


        // dd($order);
        return DataTables::eloquent($data)
            // ->editColumn('price', function ($data) {

            //     return number_format($data->price / 100, 2);
            // })
            ->editColumn('balance', function ($data) {

                return number_format($data->balance / 100, 2);
            })
            ->editColumn('propose_price', function ($data) {

                return number_format($data->propose_price / 100, 2);
            })

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function ($data) {


                return $data->updated_at->diffForHumans();
            })
            ->addColumn('type', function ($data) {

                $type = "";
                if ($data->house_id == '' && $data->estat_id == "") {
                    $type = '<span class="badge badge-dark p-1 text-capitalize"> car  </span>';
                } elseif ($data->house_id == '' && $data->car_sold_id == "") {
                    $type = '<span class="badge badge-success p-1 text-capitalize">estate  </span>';
                } elseif ($data->estat_id == '' && $data->car_sold_id == "") {
                    $type = '<span class="badge badge-success p-1 text-capitalize"> house </span>';
                }

                return $type;
            })
            ->addColumn('status', function ($data) {

                $status = "";

                if ($data->status == 'negotiation') {
                    $status = '<span class="badge badge-warning p-1 text-capitalize"> ' . $data->status . '  </span>';
                } elseif ($data->status == 'approve') {
                    $status = '<span class="badge badge-success p-1 text-capitalize">' . $data->status . '  </span><br/>' .
                        '<span class="badge badge-warning p-1 text-capitalize"> wait payment  </span>';
                } elseif ($data->status == 'wait payment') {
                    $status = '<span class="badge badge-orange p-1 text-capitalize">  ' . $data->status . '  </span>';
                } elseif ($data->status == 'cancel') {
                    $status = '<span class="badge badge-danger p-1 text-capitalize">' . $data->status . '  </span>';
                } elseif ($data->status == 'paid') {
                    $status = '<span class="badge badge-purple p-1 text-capitalize"> ' . $data->status . '   </span>';
                }
                return $status;
            })
            ->addColumn('actions', function ($data) {
                $user = Auth::user();
                $type = "car";

                $button = '';
                $button .= '
                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-primary btn-sm"
                          data-placement="top"
                          title="View Order detail"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-eye blue"></i>
                        </button>
                        <a
                        href="#"
                          role="button"
                          id="' . $data->id . '"

                          class="btn btn-orange btn-sm"
                          data-placement="top"
                          title="Message"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-comments-dollar red"></i>
                        </a>';
                if ($user->type == 'seller') {
                    if ($data->status == 'negotiation') {

                        $button .= '
                        <button
                          type="button"
                        onclick="approveCancel(' . $data->id . ')"
                          role="button"
                          id="' . $data->id . '"

                          class="btn btn-success btn-sm"
                          data-placement="top"
                          title="Valid or cancel the propose"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-check red"></i>
                        </button>';
                    }
                }

                if ($user->type == 'user') {
                    if ($data->status == 'approve') {
                        $button .= '<a
                        href="/order/payment/' . $data->id . '/' . $type . '"
                          role="button"
                          id="' . $data->id . '"

                          class="btn btn-purple btn-sm"
                          data-placement="top"
                          title="Make Payment"

                        >
                          <i class="fa fa-dollar-sign red"></i>
                        </a>';
                    }
                }

                return $button;
            })

            ->rawColumns(['type', 'status', 'actions'])
            ->toJson();
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

        $user = auth()->user();
        $id = $request['car_sold_id'];
        $car_sold = Car::findOrFail($id);
        $owner = $car_sold->owner_id;

        if ($user->id == $owner) {

            return back()->withInput("status", "You can't buy your car.");
        } else {
            $this->validate($request, [
                'your_propose_price' => ['required', 'numeric'],
                'country' => ['required'],
                'state_or_province' => ['required'],
                'city' => ['required'],

            ]);
            $order_exit = Order::where('car_id', $id)->where('customer_id', $user->id)->firstOrFail();
            if ($order_exit != "") {
                return redirect()->route('order.fail');
            } else {
                $order = new Order();
                $address = new Address();
                $address->country_id = $request['country'];
                $address->city = $request['state_or_province'];
                $address->state = $request['city'];
                $address->save();

                $latestOrder = Order::orderBy('created_at', 'DESC')->first();
                if ($latestOrder == "") {
                    $order->code = date('ymd') . '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
                } else {
                    $order->code = date('ymd') . '#' . str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
                }


                $order->customer_id = $user->id;
                $order->car_id = $car_sold->id;
                $order->country_id = $request['country'];
                $order->owner_id = $owner;
                $order->address_id = $address->id;
                $order->status = "negotiation";
                $order->price = $car_sold->price * 100;
                $order->propose_price = $request['your_propose_price'] * 100;
                $order->balance = ($car_sold->price - $request['your_propose_price']) * 100;
                $order->save();

                $messege = new Message();
                $messege->subjecte = "price Propose";
                $messege->message = "Am proposing this price " . $car_sold->max_price . " and am stell open to negoatiation";
                $messege->from = $user->id;
                $messege->to = $owner;
                $messege->save();



                DB::table('message_order')->insert([
                    'message_id' => $messege->id,
                    'order_id' => $order->id,
                ]);
                $customer = User::findOrFail($user->id);
                $owner = User::findOrFail($owner);
                $address = Address::findOrFail($address->id);
                $car = Car::findOrFail($car_sold->id);
                $car_model = CarModel::findOrFail($car->car_model_id);

                Mail::to($request->user())->send(new OrderShipped($order,  $address,  $owner,  $customer, $car, $car_model));
                Mail::to($owner->email)->send(new OrderShipped($order,  $address,  $owner,  $customer, $car, $car_model));
                return redirect()->route('order.success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (request()->ajax()) {
            $user = Auth::user();

            if ($user->type == 'user') {
                $data = Order::with(['user', 'owner', 'address', 'country', 'car'])->where('customer_id', $user->id)->where('id', $id)->get();
            }
            if ($user->type == 'seller' || $user->type == 'admin') {
                $data = Order::with(['user', 'owner', 'address', 'country', 'car'])->where('owner_id', $user->id)->where('id', $id)->get();
            }
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
    }
    public function approveCancel(Request $request, $id)
    {

        $user = Auth::user();


        if ($user->type == 'seller') {
            $order = Order::findOrFail($id);
            $order->status = $request['approve'];
            $order->update();
            $customer = User::findOrFail($user->id);
            $owner = User::findOrFail($order->owner_id);
            $car = Car::findOrFail($order->car_id);
            $car_model = CarModel::findOrFail($car->car_model_id);
            Mail::to($request->user())->send(new Approve($order, $owner, $customer, $car, $car_model));
            Mail::to($owner->email)->send(new ApproveSeller($order, $owner, $customer, $car, $car_model));
            return response()->json(['success' => 'Data updated successfully.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
    }
}

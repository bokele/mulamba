@extends('layouts.app-mail')
@section('content')
<div class="container">
    <div class="row">
        <!-- BEGIN INVOICE -->
        <div class="col-xs-12">
            <div class="grid invoice">
                <div class="grid-body">
                    <div class="invoice-title">
                        <div class="row">
                            <div class="col-xs-12">
                                <img src="{{ asset('logo.png')}}" alt="" height="35">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>invoice<br>
                                    <span class="small">{{$order->code}}</span></h2>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4">
                            <address>
                                <strong>Pick up Address:</strong><br>
                                {{$customer->name}} - {{$customer->email}}<br>
                                {{$pick_up->city}},
                                {{$pick_up->state}},
                                {{$pick_up->country->name}}<br>
                                {{-- <abbr title="Phone">P:</abbr>  --}}
                            </address>
                        </div>

                        <div class="col-xs-4 text-right">
                            <address>
                                <strong>Drop of Address:</strong><br>
                                {{$customer->name}} - {{$customer->email}}
                                {{$drop_of->city}}<br>
                                {{$drop_of->state}}<br>
                                {{$drop_of->country->name}}<br>
                                {{-- <abbr title="Phone">P:</abbr> (123) 345-6789--}}
                            </address>
                        </div>
                        <div class="col-xs-4">
                            <address>
                                <strong>Car Owner:</strong><br>
                                {{$owner->name}} - {{$owner->email}}<br>

                                {{-- <abbr title="Phone">P:</abbr>  --}}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-xs-6">
                            <address>
                                <strong>Payment Method:</strong><br>
                                Visa ending **** 1234<br>
                                h.elaine@gmail.com<br>
                            </address>
                        </div> --}}
                        <div class="col-xs-4 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{$order->created_at->format('d M,Y H:i:s')}}
                            </address>
                        </div>
                        <div class="col-xs-4 text-right">
                            <address>
                                <strong>Start Date:</strong><br>
                                {{date("d-m-Y", strtotime($booking->start_date))}}
                            </address>
                        </div>
                        <div class="col-xs-4 text-right">
                            <address>
                                <strong>End Date:</strong><br>
                                {{date("d-m-Y", strtotime($booking->end_date))}}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>ORDER SUMMARY</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" border="1px" style="width:100%">
                                    <thead>
                                        <tr class="line">
                                            <td border="1px"><strong>#</strong></td>
                                            <td class="text-center" border="1px"><strong>Product</strong></td>
                                            <td class="text-center" border="1px"><strong>Price</strong></td>
                                            <td class="text-center" border="1px"><strong>Qt</strong></td>
                                            <td class="text-right" border="1px"><strong>SUBTOTAL</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td border="1px">

                                                {{$car_model->brand}}, {{$car_model->model}},
                                                , {{$car_model->vehicle_type}}, {{$car_model->year}}<br />
                                                {{$car->Vehicle_identification_number}}<br />{{$car->vehicle_registration}}<br />
                                                {{$car->mileage}} , {{$car->vehicle_gear_box_type}}

                                            </td>
                                            <td class="text-center" border="1px">
                                                {{$order->currency}}{{number_format($order->price /100, 2)}}</td>
                                            <td class="text-center" border="1px">
                                                {{$order->currency}}{{$booking->days}}</td>
                                            <td class="text-right" border="1px">
                                                {{$order->currency}}{{number_format($order->propose_price/100, 2)}}</td>
                                        </tr>


                                        <tr>
                                            <td colspan="3" border="1px"></td>
                                            <td class="text-right" border="1px"><strong>Taxes</strong></td>
                                            <td class="text-right" border="1px"><strong>N/A</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" border="1px">
                                            </td>
                                            <td class="text-right" border="1px"><strong>Balance</strong></td>
                                            <td class="text-right" border="1px">
                                                <strong>{{$order->currency}}{{number_format(0,2)}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" border="1px">
                                            </td>
                                            <td class="text-right" border="1px"><strong>Total</strong></td>
                                            <td class="text-right" border="1px">
                                                <strong>{{$order->currency}}{{number_format($order->propose_price /100, 2)}}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset($car->cover_image)}}" alt="car cver image">
                    <div class="row">
                        <div class="col-md-6 ">
                            {{-- @component('mail::button', ['url' => $url]) --}}
                            View Order
                            {{-- @endcomponent --}}
                        </div>
                        <div class="col-md-6 text-right identity">
                            Thanks,<br>
                            {{ config('app.name') }}, Business Team
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INVOICE -->
    </div>
</div>
@endsection
@section('paymentcss')
<style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    .invoice {
        padding: 30px;
    }

    .invoice h2 {
        margin-top: 0px;
        line-height: 0.8em;
    }

    .invoice .small {
        font-weight: 300;
    }

    .invoice hr {
        margin-top: 10px;
        border-color: #ddd;
    }

    .invoice .table tr.line {
        border-bottom: 1px solid #ccc;
    }

    .invoice .table td {
        border: none;
    }

    .invoice .identity {
        margin-top: 10px;
        font-size: 1.1em;
        font-weight: 300;
    }

    .invoice .identity strong {
        font-weight: 600;
    }


    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@component('mail::message')


You are order has been aprove, you can now go to you finance section -> order and make the payment


@component('mail::button', ['url' => $url])
Click here for payment
@endcomponent



@component('mail::table')

<h3>ORDER SUMMARY</h3>


| Laravel | Sold | Paid |SUBTOTAL |
| ------------- |:-------------:| --------:|:-------------:|
|{{$car_model->brand}}, {{$car_model->model}},
,{{$car_model->vehicle_type}}, {{$car_model->year}}
{{$car->Vehicle_identification_number}}
{{$car->vehicle_registration}}
{{$car->mileage}} , {{$car->vehicle_gear_box_type}} | {{$order->currency}}{{number_format($order->price /100, 2)}} |
{{$order->currency}}{{number_format($order->propose_price/100, 2)}}
|{{$order->currency}}{{number_format($order->propose_price/100, 2)}}|
| Taxes: N/A|
| Balance: {{$order->currency}}{{number_format(($order->price/100) - ($order->propose_price/100), 2)}}|
| Total:{{$order->currency}}{{number_format($order->propose_price /100, 2)}}|




@endcomponent

Thanks,<br>
{{ config('app.name') }}, Business Team
@endcomponent

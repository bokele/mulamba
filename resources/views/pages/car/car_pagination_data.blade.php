@foreach($cars as $row)
<div class="col-md-4 mb-3">
    <div class="card h-100">
        <img src="{{asset($row->cover_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center font-weight-bold text-uppercase text-orange">
                {{$row->brand}}</h5>
            <h5 class="card-title text-center font-weight-bold text-uppercase text-success">
                {{$row->status}}</h5>
            {{-- //text-truncate --}}

            <p class="card-text ">
                {{--<?php
            //$str = $row->description_of_feature;
           // echo  htmlspecialchars($str)
           //;
            ?>--}}
                <h5 class="text-orange font-weight-bold text-center">Price:{{ number_format($row->price/100,2)}}</h5>
            </p>
            <div class="card-body">

                <br />Model :{{$row->model}}

                <br />Gear box type :{{$row->vehicle_gear_box_type}}
                <br /> Registration:{{$row->vehicle_registration}}
                <br /> Seat count :{{$row->vehicle_seat_count}}
                <br /> Door count :{{$row->vehicle_door_count}}
                <br />Mileage :{{$row->mileage}}
                <br />Country:{{$row->country_name}}

            </div>
            <a href="/boutiques/car/{{$row->id}}/detail" class="btn btn-purple">More info</a>
            @if($row->status == 'sale')
            <a href="/boutiques/car/{{$row->id}}/propose-price" class="btn btn-outline-orange">Buy
                Now</a>
            @elseif($row->status == 'rent')

            <a href="/boutiques/car/{{$row->id}}/rental" class="btn btn-outline-orange">Let
                Now</a>
            <a href="/boutiques/car/{{$row->id}}/booking" class="btn btn-info">Booking
            </a>

            @endif

        </div>
    </div>
</div>
@endforeach
{!! $cars->links() !!}

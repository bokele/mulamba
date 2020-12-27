@extends('layouts.layout')

@section('page-title')
Boutiques | Car | Booking

@endsection
@section('page-subtitle')
Car Booking

@endsection
@section('title-link')
<li><a href="#">boutiques</a></li>
<li><a href="{{route('car.get')}}">car</a></li>
<li><a href="{{route('boutiques.car.detail',$car_id)}}">car detail</a></li>
<li>Booking</li>

@endsection
@section('content')
@if (session('status'))
<div class="alert alert-info">
    {{ session('status') }}
</div>
@endif
<div class="card">
    <h5 class="card-header bg-purple text-center">Featured</h5>
    <div class="card-body">
        <form method="post" id="user_form" class="form-horizontal" action="{{route('boutiques.car.booking.store')}}">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <input type="email" id="user_email" value="{{Auth::user()->email | ''}}"
                                    placeholder="Full name" id="user_full_name" class="form-control" disabled />
                            </div>

                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="full_name"></strong>
                            </span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_email">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="email" id="user_email" value="{{Auth::user()->email | ''}}"
                                    name="user_email" placeholder="Email Address" class="form-control " disabled />
                            </div>

                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="email"></strong>
                            </span>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="brand">Brand, Modl, Type, year</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>

                                <select id="brand" name="brand" class="form-control " disabled>
                                    <option value="">Select your brand</option>
                                    <option value="other">Other</option>
                                    @foreach ($car_brand as $brand)
                                    <option value="{{$brand->id}}" @if($brand->id == $car_sold->car_model_id)
                                        selected @endif
                                        >
                                        {{$brand->brand}}, {{$brand->model}},
                                        {{$brand->vehicle_type}}, {{$brand->year}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>




                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">
                                Price Per Day
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="price" value="{{number_format($car_sold->price / 100,2)}}"
                                    name="price" placeholder="Price" class="form-control " disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="max_days">
                                Day
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>
                                <input type="number" id="max_days" value="{{old('max_days')}}" name="max_days"
                                    placeholder="max days"
                                    class="form-control @error('max_days') is-invalid @enderror" />
                                @error('max_days')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount">
                                Total Price
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>
                                <input type="number" id="amount" value="{{old('amount')}}" name="amount"
                                    placeholder="Total price" class="form-control " disabled />
                            </div>
                        </div>
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">
                                State Date
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>
                                <input type="date" id="start_date" value="{{old('start_date')}}" name="start_date"
                                    placeholder="" class="form-control @error('start_date') is-invalid @enderror " />

                            </div>
                            @error('start_date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">
                                End date
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>
                                <input type="date" id="end_date" value="{{old('end_date')}}" name="end_date"
                                    placeholder="Total price"
                                    class="form-control @error('end_date') is-invalid @enderror" />
                            </div>
                            @error('end_date')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <h3 class="text-uppercase font-weight-bold"> Pick Up Address</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pick_up_country">Country</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>

                                <select id="pick_up_country" name="pick_up_country" value="{{ old('pick_up_country') }}"
                                    class="form-control @error('country') is-invalid @enderror" disabled>
                                    <option value="">Select your brand</option>
                                    <option value="other">Other</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}" @if ($country->id == $car_sold->country_id)
                                        selected
                                        @endif>
                                        {{$country->name}}

                                    </option>
                                    @endforeach
                                </select>

                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pick_up_state_or_province">State / Province</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="pick_up_state_or_province" name="pick_up_state_or_province"
                                    value="{{ old('pick_up_state_or_province') }}" placeholder="state or province"
                                    class="form-control @error('pick_up_state_or_province') is-invalid @enderror" />
                                @error('pick_up_state_or_province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pick_up_city">City</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="pick_up_city" name="pick_up_city" placeholder="City"
                                    value="{{ old('pick_up_city') }}"
                                    class="form-control @error('pick_up_city') is-invalid @enderror" />
                                @error('pick_up_city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>
                </div>

                <h3 class="text-uppercase font-weight-bold"> Drop Of Address</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="drop_of_country">Country</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>

                                <select id="drop_of_country" name="drop_of_country" value="{{ old('drop_of_country') }}"
                                    class="form-control @error('country') is-invalid @enderror" disabled>
                                    <option value="">Select your brand</option>
                                    <option value="other">Other</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}" @if ($country->id == $car_sold->country_id)
                                        selected
                                        @endif>
                                        {{$country->name}}

                                    </option>
                                    @endforeach
                                </select>

                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drop_of_state_or_province">State / Province</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="drop_of_state_or_province" name="drop_of_state_or_province"
                                    value="{{ old('drop_of_state_or_province') }}" placeholder="state or province"
                                    class="form-control @error('drop_of_state_or_province') is-invalid @enderror" />
                                @error('drop_of_state_or_province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="drop_of_city">City</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="drop_of_city" name="drop_of_city" placeholder="City"
                                    value="{{ old('drop_of_city') }}"
                                    class="form-control @error('drop_of_city') is-invalid @enderror" />
                                @error('drop_of_city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>


                </div>
                <input type="hidden" value="{{$car_sold->id}}" name="car_id" />
                <input type="hidden" value="{{$car_sold->price/100}}" id="or_price" />
                <input type="hidden" value="{{$car_sold->country_id}}" id="country_id" name="country_id" />


                <button type="submit" class="btn btn-outline-purple btn-block">Send your
                    <i class="fa fa-space-shuttle" aria-hidden="true"></i> Booking Order</button>

            </div>
        </form>

    </div>
</div>
@endsection
@section('javascript')
<script type='text/javascript'>
    $(document).ready(function () {
        $('#max_days').keyup( function(){
            let days = $('#max_days').val();
            let price = $('#or_price').val();
            qty_days = parseFloat(days);
            day_price = parseFloat(price);
            let total =0;
            if (!isNaN(qty_days)) {
             total = price * days;
            }
            $('#amount').val(total);
            $('#total_amount').val(total);

        })
    });


</script>
@endsection

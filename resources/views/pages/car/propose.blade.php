@extends('layouts.layout')

@section('page-title')
Boutiques | Car | price propose

@endsection
@section('page-subtitle')
Car price propose

@endsection
@section('title-link')
<li><a href="#">boutiques</a></li>
<li><a href="/">car</a></li>
<li><a href="{{route('boutiques.car.detail',$car_id)}}">car detail</a></li>
<li>price propose</li>

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
        <form method="post" id="user_form" class="form-horizontal" action="{{route('order.create')}}">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_price">
                                Price
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="email" id="max_price" value="{{number_format($car_sold->price,2)}}"
                                    name="max_price" placeholder="Price" class="form-control " disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="your_propose_price">
                                Your Price
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="your_propose_price" name="your_propose_price" placeholder="Price"
                                    value="{{ old('your_propose_price') }}"
                                    class="form-control @error('your_propose_price') is-invalid @enderror" />
                                @error('your_propose_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-genderless"></span>
                                    </div>
                                </div>

                                <select id="country" name="country" value="{{ old('country') }}"
                                    class="form-control @error('country') is-invalid @enderror">
                                    <option value="">Select your brand</option>
                                    <option value="other">Other</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">
                                        {{$country->name}}

                                    </option>
                                    @endforeach
                                </select>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state_or_province">State / Province</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="state_or_province" name="state_or_province"
                                    value="{{ old('state_or_province') }}" placeholder="state or province"
                                    class="form-control @error('state_or_province') is-invalid @enderror" />
                                @error('state_or_province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input type="text" id="city" name="city" placeholder="City" value="{{ old('city') }}"
                                    class="form-control @error('city') is-invalid @enderror" />
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                        </div>
                    </div>





                </div>
                <input type="hidden" value="{{$car_sold->id}}" name="car_sold_id" />
                <button type="submit" class="btn btn-outline-orange btn-block">Send your
                    <i class="fa fa-space-shuttle" aria-hidden="true"></i> Submit your propose</button>

            </div>
        </form>

    </div>
</div>
@endsection
@section('javascript')
<script type='text/javascript'>
    $(document).ready(function () {});


</script>
@endsection

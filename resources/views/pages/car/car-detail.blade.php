@extends('layouts.layout')

@section('page-title')
Boutiques | Car | detail

@endsection
@section('page-subtitle')
Car detail

@endsection
@section('title-link')
<li><a href="#">boutiques</a></li>
<li><a href="{{route('car.get')}}">car</a></li>
<li>detail</li>

@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6 col-md-4">
                <img src="{{asset($car->cover_image)}}" alt="Kodak Brownie Flash B Camera"
                    class="image-responsive mx-auto d-block" />
                <h4 class="text-center font-weight-bold text-uppercase text-success ">

                    @if ($car->status == 'sale')
                    in stock
                    @else
                    Let
                    @endif

                </h4>
                <span></span>
            </div>
            <div class="col-md-8">
                <div class="col-md-12">
                    <h1>{{$car->brand}} </h1>
                    <h4>Model: {{$car->model}}</h4>
                    <h6 class="car-colors">Color: <span class="car-color " style="background: {{$car->color}};"></span>
                    </h6>
                    <h6 class="car-colors">Code: <span class=" "> {{$car->code}}</span>
                    </h6>

                    {{-- <span class="monospaced">No. 1960140180</span> --}}

                </div>
                <div class="col-md-12 bottom-rule">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 class="product-price text-orange">${{number_format($car->price/100, 2)}}</h4>
                        </div>
                        <div class="col-md-7">
                            @if($car->status == 'sale')
                            <a href="/boutiques/car/{{$car->id}}/propose-price" class="btn btn-outline-orange">Send your
                                propose
                                price</a>
                            @elseif($car->status == 'rent')
                            <a href="/boutiques/car/{{$car->id}}'/rental" class="btn btn-outline-orange">Let Now</a>
                            <a href="/boutiques/car/{{$car->id}}/booking" class="btn btn-info">Booking it
                            </a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-12 ">
                <nav class="nav nav-pills nav-justified" id="myTab" role="tablist">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                        aria-controls="description" aria-selected="true">Description</a>

                    <a class="nav-link" href="#feature" id="feature-tab" data-toggle="tab" href="#feature" role="tab"
                        aria-controls="feature" aria-selected="false">Feature</a>

                    <a class="nav-link" href="#images" data-toggle="tab" href="#images" role="tab"
                        aria-controls="images" aria-selected="false">images</a>

                </nav>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">


                        <p>{{$car->description_of_feature}}</p>
                    </div>
                    <div class="tab-pane fade" id="feature" role="tabpanel" aria-labelledby="feature-tab">
                        <br /><span class="font-weight-bold">Gear box type : &nbsp;</span><span
                            class="text-capitalize">{{$car->vehicle_gear_box_type}}</span>
                        <br /><span class="font-weight-bold">Fuel
                            type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            :
                            &nbsp;</span><span class="text-capitalize">{{$car->vehicle_fuel_type}}</span>
                        <br /> <span class="font-weight-bold">Registration&nbsp;&nbsp;&nbsp;&nbsp;:

                            &nbsp;</span>{{$car->vehicle_registration}}
                        <br /> <span class="font-weight-bold">Identification&nbsp;&nbsp;:

                            &nbsp;</span>{{$car->Vehicle_identification_number}}
                        <br /><span class="font-weight-bold"> Seat count&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            :</span>&nbsp;{{$car->vehicle_seat_count}}
                        <br /> <span class="font-weight-bold">Door count&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            :</span>&nbsp;{{$car->vehicle_door_count}}
                        <br /><span
                            class="font-weight-bold">Mileage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            :</span>&nbsp;{{$car->mileage}}
                        <br /><span
                            class="font-weight-bold">Country&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span><span
                            class="text-capitalize">&nbsp;{{$car->country_name}}</span>
                    </div>
                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                        <!-- ======= Portfolio Section ======= -->
                        <section id="portfolio" class="portfolio">
                            <div class="container">
                                <div class="row" data-aos="fade-up">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <ul id="portfolio-flters">
                                            <li data-filter=".filter-app"></li>


                                        </ul>
                                    </div>
                                </div>


                                <div class="row portfolio-container" data-aos="fade-up">

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->front_car_image)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Front</h4>
                                            <p>Images</p>
                                            <a href="{{asset($car->front_car_image)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="App 1"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->car_left_side)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Left Side</h4>
                                            <p>Images</p>
                                            <a href="{{asset($car->car_left_side)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="Web 3"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>



                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->car_right_side)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Right side</h4>
                                            <p>Image</p>
                                            <a href="{{asset($car->front_car_image)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="Card 2"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->car_behind_image)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Car behind image</h4>
                                            <p>Image</p>
                                            <a href="{{asset($car->car_behind_image)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="Web 2"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->dashbooard_image)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Dashbooard</h4>
                                            <p>Image</p>
                                            <a href="{{asset($car->dashbooard_image)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="App 3"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <img src="{{asset($car->inside_image)}}" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <h4>Inside </h4>
                                            <p>Image</p>
                                            <a href="{{asset($car->inside_image)}}" data-gall="portfolioGallery"
                                                class="venobox preview-link" title="Card 1"><i
                                                    class="bx bx-plus"></i></a>

                                        </div>
                                    </div>





                                </div>

                            </div>
                        </section><!-- End Portfolio Section -->
                    </div>
                </div>
            </div>
        </div>
        <div class=”row”>


            <div class="row">
                <div class="col-md-12 top-10">
                    {{-- <p>To order by telephone, <a href="tel:18005551212">please call 1-800-555-1212</a></p> --}}
                </div>
            </div><!-- end row -->

        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type='text/javascript'>
    $(document).ready(function () {});


</script>
@endsection

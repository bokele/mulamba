@extends('layouts.layout')

@section('page-title')
Boutiques | Car | House | Estate |

@endsection
@section('content')
{{-- car section  --}}
<div class="section-title" data-aos="fade-up">
    <h2 class="font-weight-bold text-uppercase text-orange"><strong>Car for Sale and Let</strong></h2>
</div>
<div class="col-md-12">

    <div class="row" id="boutique-car">
    </div>
    <a href="{{route('car.get')}}" class="btn btn-outline-purple btn-lg btn-block">More car to Let and to Buy</a>
</div>
{{-- House section  --}}

<div class="section-title mt-5" data-aos="fade-up">
    <h2 class="font-weight-bold text-uppercase text-orange "><strong>House for Sale and Let</strong></h2>
</div>

<div class="col-md-12">

    <div class="row" id="boutique-house">
    </div>
    <a href="{{route('house.get')}}" class="btn btn-outline-purple btn-lg btn-block">More House to Let and to Buy</a>
</div>
{{-- Estate section --}}

<div class="section-title mt-5" data-aos="fade-up">
    <h2 class="font-weight-bold text-uppercase text-orange "><strong>House for Sale and Let</strong></h2>
</div>

<div class="col-md-12">

    <div class="row" id="boutique-estate">
    </div>
    <button type="button" class="btn btn-outline-purple btn-lg btn-block">More Estate to Buy</button>
</div>

@endsection

@section('javascript')
<script type='text/javascript'>
    $(document).ready(function () {
    $.ajax({
		url: '{{ route("boutiques.data")}}',
		method: "GET",
		dataType: 'json',
		success: function (response) {
            // console.log(response.cars.data.length);


            let car="";
            let car_length =response.cars.data.length
            for(let i = 0; i < car_length; i++){
               let cover_image = response.cars.data[i].cover_image;
              car +='<div class="col-md-4 mb-3">'+
              '<div class="card" >'+
                   ' <img src="'+cover_image+'" class="card-img-top" alt="...">'+
                   '<div class="card-body">'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-orange">'+response.cars.data[i].brand+'</h5>'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-success">'+response.cars.data[i].status+'</h5>'+
                    //    ' <p class="card-text text-truncate">'+response.cars.data[i].car.description_of_feature+'</p>'+
                       '<div class="card-body">'+
 '<h5 class="text-orange font-weight-bold text-center">Price:'+response.cars.data[i].max_price+'</h5>'+
                       '<br />Model :'+response.cars.data[i].model+

                       '<br/>Gear box type :'+response.cars.data[i].car.vehicle_gear_box_type+
                       '<br/> Registration:'+response.cars.data[i].car.vehicle_registration+
                       '<br/> Seat count :'+response.cars.data[i].car.vehicle_seat_count+
                       '<br/> Door count :'+response.cars.data[i].car.vehicle_door_count+
                       '<br />Mileage :'+response.cars.data[i].car.mileage+
                       '<br />Country:'+response.cars.data[i].country_name+

                       ' </div>'+
                       ' <a href="/boutiques/car/'+response.cars.data[i].id+'/detail" class="btn btn-purple">More info</a>';
                       if(response.cars.data[i].status == 'in stock'){
                            car +=' <a href="/boutiques/car/'+response.cars.data[i].id+'/propose-price"  class="btn btn-outline-orange">Buy Now</a>';
                       }else if(response.cars.data[i].status == 'rental'){
                           car +=' <a href="/boutiques/car/'+response.cars.data[i].id+'/rental"  class="btn btn-outline-orange">Let Now</a>';
                       }


                   car +=' </div>'+
                   ' </div>'+
                    '</div>';

            }


            $('#boutique-car').html(car);
            let houses="";
            let house_length =response.houses.data.length
            for(let i = 0; i < house_length; i++){
               let cover_image = response.houses.data[i].cover_image;
              houses +='<div class="col-md-4 mb-3">'+
              '<div class="card" >'+
                   ' <img src="'+cover_image+'" class="card-img-top" alt="...">'+
                   '<div class="card-body">'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-orange">'+response.houses.data[i].max_price+'</h5>'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-success">'+response.houses.data[i].status+'</h5>'+
                    //    ' <p class="card-text text-truncate">'+response.cars.data[i].car.description_of_feature+'</p>'+
                       '<div class="card-body">'+

                       '<br />Estate space size :'+response.houses.data[i].estate_space_size+

                       '<br/>House space size :'+response.houses.data[i].house_space_size+
                       '<br/> Number of bathrooms:'+response.houses.data[i].number_of_bathrooms+
                       '<br/> Number of bedrooms :'+response.houses.data[i].number_of_bedrooms+
                       '<br/> Number of garages :'+response.houses.data[i].number_of_garages+
                       '<br />Country:'+response.houses.data[i].country_name+

                       ' </div>'+
                       ' <a href="#" class="btn btn-purple">More info</a>';
                       if(response.houses.data[i].status == 'in stock'){
                            houses +=' <button type="button"  class="btn btn-outline-orange">Buy Now</button>';
                       }else if(response.houses.data[i].status == 'let'){
                           houses +=' <button type="button"  class="btn btn-outline-orange">Hire Now</button>';
                       }


                   houses +=' </div>'+
                   ' </div>'+
                    '</div>';

            }


            $('#boutique-house').html(houses);

            let estate="";
            let estate_length =response.estates.data.length
            for(let i = 0; i < estate_length; i++){
               let cover_image = response.estates.data[i].cover_image;
              estate +='<div class="col-md-4 mb-3">'+
              '<div class="card" >'+
                   ' <img src="'+cover_image+'" class="card-img-top" alt="...">'+
                   '<div class="card-body">'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-orange">'+response.estates.data[i].estate_name+'</h5>'+
                        '<h5 class="card-title text-center font-weight-bold text-uppercase text-success">'+response.estates.data[i].status+'</h5>'+
                    //    ' <p class="card-text text-truncate">'+response.cars.data[i].car.description_of_feature+'</p>'+
                       '<div class="card-body">'+
                    '<h5 class="text-orange font-weight-bold text-center">Price:'+response.estates.data[i].max_price+'</h5>'+
                       '<br />Estate space size :'+response.estates.data[i].estate_space_size+

                       '<br />Country:'+response.estates.data[i].country_name+

                       ' </div>'+
                       ' <a href="#" class="btn btn-purple">More info</a>';
                       if(response.estates.data[i].status == 'in stock'){
                            estate +=' <button type="button"  class="btn btn-outline-orange">Buy Now</button>';
                       }


                   estate +=' </div>'+
                   ' </div>'+
                    '</div>';

            }


            $('#boutique-estate').html(estate);

        } });

});

</script>
@endsection

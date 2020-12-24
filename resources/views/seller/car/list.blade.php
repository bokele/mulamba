@extends('layouts.app')
@section('page-title')
All users List
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span> Categories List
                    </h3>

                    <div class="card-tools">
                        <button class="btn btn-dark" name="create_record" id="create_record">
                            <i class="fas fa-plus fa-lg"></i> &nbsp;
                            Add New
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered dt-responsive nowrap" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">code</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Model </th>
                                    <th scope="col">Vehicle type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Vehicle registration</th>
                                    <th scope="col">Vehicle identification number</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Updated at</th>


                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('pages.modal.modal_attachment_car')
@endsection

@section('modal-content')
<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="current_status_of_registraion">registed</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="current_status_of_registraion" name="current_status_of_registraion"
                            class="form-control ">
                            <option value="">Select Status</option>
                            <option value="yes">Yes</option>
                            <option value="non">Non</option>
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_current_status_of_registraion"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="price" name="price" class="form-control " />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_price"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="color">Color</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="color" id="color" name="color" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_color"></strong>
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

                        <select id="brand" name="brand" class="form-control ">
                            <option value="">Select your brand</option>
                            <option value="other">Other</option>
                            @foreach ($car_brand as $brand)
                            <option value="{{$brand->id}}">
                                {{$brand->brand}}, {{$brand->model}},
                                {{$brand->vehicle_type}}, {{$brand->year}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_brand"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_fuel_type">Type of fuel</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="vehicle_fuel_type" name="vehicle_fuel_type" class="form-control ">
                            <option value="">Select vehicle fuel type</option>
                            <option value="electric">Electric</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">diesel</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="gas">Gas</option>
                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_fuel_type"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_door_count">Number of door</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="vehicle_door_count" name="vehicle_door_count" class="form-control ">
                            <option value="">Select number of door</option>
                            @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_door_count"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_seat_count">Number of seat</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="vehicle_seat_count" name="vehicle_seat_count" class="form-control ">
                            <option value="">Select number of seat</option>
                            @for ($i = 1; $i <= 50; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="gender"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_registration">Vehicle registration</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="vehicle_registration" name="vehicle_registration"
                            placeholder="Vehicle registration" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_registration"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Vehicle_identification_number">Vehicle identification number</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="Vehicle_identification_number" name="Vehicle_identification_number"
                            placeholder="Vehicle identification number" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_Vehicle_identification_number"></strong>
                    </span>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="mileage" name="mileage" placeholder="Mileage" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_mileage"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_gear_box_type">Gear Box</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="vehicle_gear_box_type" name="vehicle_gear_box_type" class="form-control ">
                            <option value="">Select your gear box type</option>
                            <option value="other">Other</option>
                            @foreach ($gear_boxes as $gear_box)
                            <option value="{{$gear_box->name}}">
                                {{$gear_box->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_gear_box_type"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="status" name="status" class="form-control ">
                            <option value="">Select Status</option>
                            <option value="sale">For sale</option>
                            <option value="rent">For Rent</option>


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_status"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="color">Description</label>


                    <textarea id="description_of_feature" name="description_of_feature"
                        placeholder="Description of feature" class="form-control "></textarea>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_description_of_feature"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="country_name">Country</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="country_name" name="country_name" class="form-control ">
                            <option value="">Select your country</option>

                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">
                                {{$country->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_country_name"></strong>
                    </span>

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
                            placeholder="state or province" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_state_or_province"></strong>
                    </span>

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
                        <input type="text" id="city" name="city" placeholder="City" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_city"></strong>
                    </span>

                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="hidden_address_id" id="hidden_address_id" />
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span id="action_button">
                changes</span>
        </button>
    </div>

</form>
@endsection
@push('javascripts')
<script>
    $(document).ready( function () {
        $('#description_of_feature').summernote();
    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        ajax: '{!! route("admin.get.all.cars") !!}',
        columns:[
            {data: 'actions', name: 'actions'},
            {data: 'status', name: 'status'},
            {data: 'code', name: 'code'},
            {data: 'owner', name: 'owner'},
            {data: 'country_name', name: 'country_name'},

            {data: 'car_model_brand', name: 'car_model_brand'},
            {data: 'car_model', name: 'car_model'},
            {data: 'vehicle_type', name: 'vehicle_type'},
            {data: 'price', name: 'price'},
            {data: 'vehicle_registration',  name: 'vehicle_registration'},
            {data: 'Vehicle_identification_number',  name: 'Vehicle_identification_number'},
            {data: 'created_at',  name: 'created_at'},
            {data:'updated_at', name: 'updated_at'}
    ]
    });


    $('#create_record').click(function(){
    $('.modal-title').text('Add New User');
    $('#action_button').text('Save');
    $('.modal-header').addClass('bg-dark');
    $('#modal-icon').html('<i class="fa fa-plus" aria-hidden="true"></i>');
    $('#action').val('Add');

        $("#user_form")[0].reset();
        // remove the error text
        $(".text-danger").remove();

        $()

    $('#create').modal('show');

    });

    $('#user_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('admin.car.create') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id_car = $('#hidden_id').val();
        action_url = '/admin/car/update/'+id_car;
    }

    $.ajax({
    url: action_url,
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    success:function(data)
    {
$('#error_price').text(''); $('#price').removeClass('is-invalid'); $('#price').addClass('is-valid');
$('#error_brand').text(''); $('#brand').removeClass('is-invalid'); $('#brand').addClass('is-valid');
$('#error_type_vehicule').text('');$('#type_vehicule').removeClass('is-invalid');
$('#type_vehicule').addClass('is-valid');
$('#error_vehicle_fuel_type').text(''); $('#vehicle_fuel_type').removeClass('is-invalid');
$('#vehicle_fuel_type').addClass('is-valid');
$('#error_vehicle_seat_count').text('');$('#vehicle_seat_count').removeClass('is-invalid');
$('#vehicle_seat_count').addClass('is-valid');
$('#error_vehicle_door_count').text('');$('#vehicle_door_count').removeClass('is-invalid');
$('#vehicle_door_count').addClass('is-valid');
$('#error_vehicle_registration').text(''); $('#vehicle_registration').removeClass('is-invalid');
$('#vehicle_registration').addClass('is-valid');
$('#error_vehicle_registration').text('');$('#vehicle_registration').removeClass('is-invalid');
$('#vehicle_registration').addClass('is-valid');

$('#error_vehicle_registration').text('');$('#vehicle_registration').removeClass('is-invalid');
$('#vehicle_registration').addClass('is-valid');
$('#error_Vehicle_identification_number').text(''); $('#Vehicle_identification_number').removeClass('is-invalid');
$('#Vehicle_identification_number').addClass('is-valid');
$('#error_vehicle_gear_box_type').text('');$('#vehicle_gear_box_type').removeClass('is-invalid');
$('#vehicle_gear_box_type').addClass('is-valid');
$('#error_mileage').text(''); $('#mileage').removeClass('is-invalid'); $('#bmileagerand').addClass('is-valid');
$('#error_color').text('');$('#color').removeClass('is-invalid'); $('#color').addClass('is-valid');
$('#error_description_of_feature').text('');$('#description_of_feature').removeClass('is-invalid');
$('#description_of_feature').addClass('is-valid');
$('#error_city').text('');$('#city').removeClass('is-invalid'); $('#city').addClass('is-valid');
$('#error_state_or_province').text('');$('#state_or_province').removeClass('is-invalid');
$('#state_or_province').addClass('is-valid');
$('#error_status').text('');$('#status').removeClass('is-invalid'); $('#status').addClass('is-valid');
$('#error_country_name').text('');$('#country_name').removeClass('is-invalid'); $('#country_name').addClass('is-valid');


        if(data.errors) {
            if(data.errors.price){

                $('#price').addClass('rounded-right');
                $('#price').addClass('is-invalid');
                $( '#error_price' ).text( data.errors.price[0] );
             }
            if(data.errors.brand){

                $('#brand').addClass('rounded-right');
                $('#brand').addClass('is-invalid');
                $( '#error_brand' ).text( data.errors.brand[0] );
             }
             if(data.errors.type_vehicule){

            $('#type_vehicule').addClass('rounded-right');
            $('#type_vehicule').addClass('is-invalid');
            $( '#error_type_vehicule' ).text( data.errors.type_vehicule[0] );
            }
            if(data.errors.vehicle_fuel_type){

            $('#vehicle_fuel_type').addClass('rounded-right');
            $('#vehicle_fuel_type').addClass('is-invalid');
            $( '#error_vehicle_fuel_type' ).text( data.errors.vehicle_fuel_type[0] );
            }
            if(data.errors.vehicle_seat_count){

            $('#vehicle_seat_count').addClass('rounded-right');
            $('#vehicle_seat_count').addClass('is-invalid');
            $( '#error_vehicle_seat_count' ).text( data.errors.vehicle_seat_count[0] );
            }
            if(data.errors.vehicle_registration){

            $('#vehicle_registration').addClass('rounded-right');
            $('#vehicle_registration').addClass('is-invalid');
            $( '#error_vehicle_registration' ).text( data.errors.vehicle_registration[0] );
            }

            if(data.errors.vehicle_registration){

            $('#vehicle_registration').addClass('rounded-right');
            $('#vehicle_registration').addClass('is-invalid');
            $( '#error_vehicle_registration' ).text( data.errors.vehicle_registration[0] );
        }
        if(data.errors.vehicle_registration){

            $('#vehicle_registration').addClass('rounded-right');
            $('#vehicle_registration').addClass('is-invalid');
            $( '#error_vehicle_registration' ).text( data.errors.vehicle_registration[0] );
        }
        if(data.errors.vehicle_registration){

            $('#vehicle_registration').addClass('rounded-right');
            $('#vehicle_registration').addClass('is-invalid');
            $( '#error_vehicle_registration' ).text( data.errors.vehicle_registration[0] );
        }
        if(data.errors.Vehicle_identification_number){

            $('#Vehicle_identification_number').addClass('rounded-right');
            $('#Vehicle_identification_number').addClass('is-invalid');
            $( '#error_Vehicle_identification_number' ).text( data.errors.Vehicle_identification_number[0] );
        }
        if(data.errors.vehicle_gear_box_type){

            $('#vehicle_gear_box_type').addClass('rounded-right');
            $('#vehicle_gear_box_type').addClass('is-invalid');
            $( '#error_vehicle_gear_box_type' ).text( data.errors.vehicle_gear_box_type[0] );
        }
        if(data.errors.mileage){

            $('#mileage').addClass('rounded-right');
            $('#mileage').addClass('is-invalid');
            $( '#error_mileage' ).text( data.errors.mileage[0] );
        }
        if(data.errors.color){

            $('#color').addClass('rounded-right');
            $('#color').addClass('is-invalid');
            $( '#error_color' ).text( data.errors.color[0] );
        }
        if(data.errors.description_of_feature){

            $('#description_of_feature').addClass('rounded-right');
            $('#description_of_feature').addClass('is-invalid');
            $( '#error_description_of_feature' ).text( data.errors.description_of_feature[0] );
        }
        if(data.errors.vehicle_gear_box_type){

        $('#vehicle_gear_box_type').addClass('rounded-right');
        $('#vehicle_gear_box_type').addClass('is-invalid');
        $( '#error_vehicle_gear_box_type' ).text( data.errors.vehicle_gear_box_type[0] );
        }

        if(data.errors.city){

            $('#city').addClass('rounded-right');
            $('#city').addClass('is-invalid');
            $( '#error_city' ).text( data.errors.city[0] );
        }
        if(data.errors.state_or_province){

            $('#state_or_province').addClass('rounded-right');
            $('#state_or_province').addClass('is-invalid');
            $( '#error_state_or_province' ).text( data.errors.state_or_province[0] );
        }
        if(data.errors.vehicle_door_count){

            $('#vehicle_door_count').addClass('rounded-right');
            $('#vehicle_door_count').addClass('is-invalid');
            $( '#error_vehicle_door_count' ).text( data.errors.vehicle_door_count[0] );
        }
        if(data.errors.current_status_of_registraion){

            $('#current_status_of_registraion').addClass('rounded-right');
            $('#current_status_of_registraion').addClass('is-invalid');
            $( '#error_current_status_of_registraion' ).text( data.errors.current_status_of_registraion[0] );
        }
        if(data.errors.status){

            $('#status').addClass('rounded-right');
            $('#status').addClass('is-invalid');
            $( '#error_status' ).text( data.errors.status[0] );
        }
let country = $('#country_name').val();
        if(data.errors.country_name || country == ""){

            $('#country_name').addClass('rounded-right');
            $('#catcountry_nameegory').addClass('is-invalid');
            $( '#error_country_name' ).text( data.errors.country_name[0] );
        }



        }

        if(data.success){
            $('#create').modal('hide');

            $('#user_form')[0].reset();

            $('#myTable').DataTable().ajax.reload();

            toast.fire({
            icon: "success",
            title: ""+data.success
            });

        }
    }
});

});
    } );

$(document).on('click', '.edit', function(){
var id = $(this).attr('id');
$.ajax({
url :"/admin/all-get-car/"+id+"/edit",
methode:"GET",
dataType:"json",
success:function(data)
{
    console.log(data)
$('#current_status_of_registraion').val(data.result[0].current_status_of_registraion);
$('#country_name').val(data.result[0].country_id)
$('#price').val(data.result[0].price)
$('#type_vehicule').val(data.result[0].type_vehicule);
$('#vehicle_fuel_type').val(data.result[0].vehicle_fuel_type);
$('#vehicle_seat_count').val(data.result[0].vehicle_seat_count);
$('#vehicle_registration').val(data.result[0].vehicle_registration);
$('#Vehicle_identification_number').val(data.result[0].Vehicle_identification_number);
$('#vehicle_gear_box_type').val(data.result[0].vehicle_gear_box_type);
$('#mileage').val(data.result[0].mileage);
$('#color').val(data.result[0].color);
$('#description_of_feature').summernote({focus: true});
// $('#description_of_feature').text(data.result[0].description_of_feature);
$('#description_of_feature').summernote('pasteHTML', data.result[0].description_of_feature);

$('#city').val(data.result[0].city);

$('#state_or_province').val(data.result[0].state);

$('#status').val(data.result[0].status);
$('#hidden_id').val(id);
$('#hidden_address_id').val(data.result[0].address_id);
$('.modal-title').text('Edit Record');
$('#action_button').text('Save change');
$('#action').val('Edit');
$('.modal-header').removeClass('bg-dark');
$('.modal-header').addClass('bg-warning');
$('#create').modal('show');
}
})
});
function deleteCar(id){
    Swal.fire({
        title: "Are you sure?",
        html:"You won't be able to revert this!<br /><b><span style='color:red;'> Delete user: </span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
    })
    .then((result) => {
    // Send request to the server
        if (result.value) {
            $.ajax({
                url: "/admin/car/delete/" + id,
                method:'POST',
                dataType:"json",
                success:function(data){

                    if(data.errors) {
                        swal("Failed!", "There was something wronge.", "warning");
                    }

                    if(data.success){

                        $('#myTable').DataTable().ajax.reload();

                        toast.fire({
                            icon: "success",
                            title: ""+data.success
                        });
                    }
                }
            })

        }
    });
}
$(document).on('click', '.attachment', function(){
var id = $(this).attr('id');
$('#car_id').val(id);
$('.modal-title').text('Add Documents');
$('#action_button_attachment').text('Save change');

$('.modal-header').removeClass('bg-dark');
$('.modal-header').addClass('bg-warning');
$.ajax({
url :"/admin/all-get-car/"+id+"/edit",
methode:"GET",
dataType:"json",
success:function(data)
{
    $('#current_status_of_registraion').val(data.result[0].current_status_of_registraion);
} });
$('#attachmnent').modal('show');
});

$(document).ready( function () {
$('#attachment_form').on('submit', function(event){
event.preventDefault();
$.ajax({
url:"{{ route('admin.car.sold.upload.document') }}",
method:"POST",
data:new FormData(this),
dataType:'JSON',
contentType: false,
cache: false,
processData: false,
success:function(data)
{

console.log(data.errors.white_book)
if(data.errors) {
if(data.errors.white_book){

$('#white_book').addClass('rounded-right');
$('#white_book').addClass('is-invalid');
$( '#error_white_book' ).text( data.errors.white_book[0] );
}


if(data.errors.cover_image){

$('#cover_image').addClass('rounded-right');
$('#cover_image').addClass('is-invalid');
$( '#error_cover_image' ).text( data.errors.cover_image[0] );
}
if(data.errors.front_car_image){

$('#front_car_image').addClass('rounded-right');
$('#front_car_image').addClass('is-invalid');
$( '#error_front_car_image' ).text( data.errors.front_car_image[0] );
}
if(data.errors.car_left_side){

$('#car_left_side').addClass('rounded-right');
$('#car_left_side').addClass('is-invalid');
$( '#error_car_left_side' ).text( data.errors.car_left_side[0] );
}
if(data.errors.car_right_side){

$('#car_right_side').addClass('rounded-right');
$('#car_right_side').addClass('is-invalid');
$( '#error_car_right_side' ).text( data.errors.car_right_side[0] );
}
if(data.errors.car_behind_image){

$('#car_behind_image').addClass('rounded-right');
$('#car_behind_image').addClass('is-invalid');
$( '#error_car_behind_image' ).text( data.errors.car_behind_image[0] );
}
if(data.errors.dashbooard_image){

$('#dashbooard_image').addClass('rounded-right');
$('#dashbooard_image').addClass('is-invalid');
$( '#error_dashbooard_image' ).text( data.errors.dashbooard_image[0] );
}
if(data.errors.inside_image){

$('#inside_image').addClass('rounded-right');
$('#inside_image').addClass('is-invalid');
$( '#error_inside_image' ).text( data.errors.inside_image[0] );
}

}

if(data.success){
$('#attachmnent').modal('hide');

$('#attachment_form')[0].reset();

$('#myTable').DataTable().ajax.reload();

toast.fire({
icon: "success",
title: ""+data.success
});

}

}
})
});
});
</script>
@endpush

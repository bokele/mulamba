@extends('layouts.app')
@section('page-title')
All car for sold
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


                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered dt-responsive nowrap" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Vehicle registration</th>
                                    <th scope="col">Max Price</th>
                                    <th scope="col">Min Price</th>

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
@endsection

@section('modal-attachment-content')
<form method="post" id="attachment_form" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="white_book">White Book</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input inv" id="white_book" name="white_book">
                            <label class="custom-file-label" for="white_book">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_white_book"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="tax_clearancy">Tax Clearance</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="tax_clearancy" name="tax_clearancy">
                            <label class="custom-file-label" for="tax_clearancy">Choose file</label>
                        </div>
                    </div>
                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_tax_clearancy"></strong>
                    </span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="last_insurancy">LAst Insurancy</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="last_insurancy" name="last_insurancy">
                            <label class="custom-file-label" for="last_insurancy">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_last_insurancy"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cover_image">Cover Image</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cover_image" name="cover_image">
                            <label class="custom-file-label" for="cover_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_cover_image"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="front_car_image">Front Car Image</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="front_car_image" name="front_car_image">
                            <label class="custom-file-label" for="front_car_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_front_car_image"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="car_left_side">Car left side</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="car_left_side" name="car_left_side">
                            <label class="custom-file-label" for="car_left_side">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_car_left_side"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="car_right_side">Car Ringht side</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="car_right_side" name="car_right_side">
                            <label class="custom-file-label" for="car_right_side">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_car_right_side"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="car_behind_image">Car behind Image </label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="car_behind_image" name="car_behind_image">
                            <label class="custom-file-label" for="car_behind_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_car_behind_image"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="dashbooard_image">Dashboard Image</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="dashbooard_image" name="dashbooard_image">
                            <label class="custom-file-label" for="dashbooard_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_dashbooard_image"></strong>
                </span>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inside_image">Inside image</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inside_image" name="inside_image"
                                data-browse-on-zone-click="true">
                            <label class="custom-file-label" for="inside_image">Choose file</label>
                        </div>
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_inside_image"></strong>
                </span>
            </div>

        </div>


    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="car_sold_id" id="car_sold_id" />

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span
                id="action_button_attachment">
                changes</span>
        </button>
    </div>
</form>

@endsection

@section('modal-content')
<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

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
                        <input type="text" name="user_full_name" placeholder="Full name" id="user_full_name"
                            class="form-control" disabled />
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
                        <input type="email" id="user_email" name="user_email" placeholder="Email Address"
                            class="form-control " disabled />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="email"></strong>
                    </span>

                </div>
            </div>


            <div class="col-md-8">
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
            <div class="col-md-4">
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
                            <option value="in stock">In stock</option>
                            <option value="sold">For Sold</option>
                            <option value="rental">For Rent</option>
                            <option value="remove">Remove</option>
                            <option value="buy">Buy</option>

                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_status"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="max_price">Max Price<span></label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="number" id="max_price" name="max_price" placeholder="Max price"
                            class="form-control " />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_max_price"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="min_price">Min Price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="number" id="min_price" name="min_price" class="form-control ">
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_min_price"></strong>
                    </span>

                </div>
            </div>



        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="hidden_car_id" id="hidden_car_id" />
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span id="action_button">
                changes</span>
        </button>
    </div>

</form>
@endsection
@push('scripts')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        ajax: '{!! route("admin.get.all.cars.sold") !!}',
        columns:[
            {data: 'actions', name: 'actions'},
            {data: 'status', name: 'status'},
            {data: 'country_name', name: 'country_name'},
            {data: 'owner', name: 'owner'},
            {data: 'brand', name: 'brand'},
            {data: 'vehicle_registration', name: 'vehicle_registration'},
            {data: 'max_price', name: 'max_price'},
            {data: 'min_price', name: 'min_price'},
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
        action_url = '/admin/car/sold/update/'+id_car;
    }

    $.ajax({
    url: action_url,
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    success:function(data)
    {

        if(data.errors) {
            if(data.errors.max_price){

                $('#max_price').addClass('rounded-right');
                $('#max_price').addClass('is-invalid');
                $( '#error_max_price' ).text( data.errors.max_price[0] );
             }
            if(data.errors.status){

                $('#status').addClass('rounded-right');
                $('#status').addClass('is-invalid');
                $( '#error_status' ).text( data.errors.status[0] );
            }
            if(data.errors.min_price){

                $('#min_price').addClass('rounded-right');
                $('#min_price').addClass('is-invalid');
                $( '#error_min_price' ).text( data.errors.min_price[0] );
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
url :"/admin/all-get-car-sold/"+id+"/edit",
methode:"GET",
dataType:"json",
success:function(data)
{

$('#user_full_name').val(data.result[0].name);
$('#user_email').val(data.result[0].email);
$('#brand').val(data.result[0].brand);
$('#min_price').val(data.result[0].min_price);
$('#max_price').val(data.result[0].max_price);

$('#status').val(data.result[0].status);
$('#hidden_id').val(id);
$('#hidden_car_id').val(data.result[0].car_id);
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
                url: "/admin/car/sold/delete/" + id,
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
$('#car_sold_id').val(id);
$('.modal-title').text('Add Documents');
$('#action_button_attachment').text('Save change');

$('.modal-header').removeClass('bg-dark');
$('.modal-header').addClass('bg-warning');
$('#attachmnent').modal('show');
});

$(document).ready(function(){

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
    if(data.errors.tax_clearancy){

    $('#tax_clearancy').addClass('rounded-right');
    $('#tax_clearancy').addClass('is-invalid');
    $( '#error_tax_clearancy' ).text( data.errors.tax_clearancy[0] );
    }
    if(data.errors.last_insurancy){

    $('#last_insurancy').addClass('rounded-right');
    $('#last_insurancy').addClass('is-invalid');
    $( '#error_last_insurancy' ).text( data.errors.last_insurancy[0] );
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

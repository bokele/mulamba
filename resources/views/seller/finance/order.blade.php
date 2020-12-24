@extends('layouts.app')
@section('page-title')
All orders
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            @if (session('success'))
            <div class="alert alert-success" role="alert">

            </div>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>{{ session('success') }}</p>
                <hr>
                <p class="mb-0">Check your email box</p>
            </div>
            @endif
            <div class="card ">
                <div class="card-header bg-purple">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span> Order List
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
                                    <th scope="col">Reference</th>
                                    <th scope="col">Type</th>

                                    <th scope="col">Max Price</th>
                                    <th scope="col">Propose Price</th>
                                    <th scope="col">Balance</th>
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
@include('pages.modal.order-view')
@endsection






@push('javascripts')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        ajax: '{!! route("finance.management.get.orders") !!}',
        columns:[
            {data: 'actions', name: 'actions'},
            {data: 'status', name: 'status'},
            {data: 'code', name: 'code'},
            {data: 'type', name: 'type'},
            {data: 'price', name: 'price'},
            {data: 'propose_price', name: 'propose_price'},
            {data: 'balance', name: 'balance'},
            {data: 'created_at',  name: 'created_at'},
            {data:'updated_at', name: 'updated_at'}
    ]
    });


    $('#payment-modal').click(function(){
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
    // action_url = "";
    }

    if($('#action').val() == 'Edit')
    {
        var house_id = $('#hidden_id').val();
        action_url = '/admin/estate/update/'+house_id;
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
            if(data.errors.full_address){

            $('#full_address').addClass('rounded-right');
            $('#full_address').addClass('is-invalid');
            $( '#error_full_address' ).text( data.errors.full_address[0] );
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
            if(data.errors.street_name){

            $('#street_name').addClass('rounded-right');
            $('#street_name').addClass('is-invalid');
            $( '#error_street_name' ).text( data.errors.street_name[0] );
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
url :"/order/edit/"+id,
methode:"GET",
dataType:"json",
success:function(data)
{
 console.log(data.result[0].user.name)
 $('#code').text( 'sdfsdf')
$('#owner_name').val(data.result[0].owner.name);
$('#owner_email').val(data.result[0].owner.email);
$('#customer_name').val(data.result[0].user.name);
$('#customer_email').val(data.result[0].user.email);
$('#balance').val(data.result[0].balance);
$('#price').val(data.result[0].price);
$('#propose_price').val(data.result[0].propose_price);
$('#brand').val(data.result[0].car.car_model_id);



$('#country').val(data.result[0].address.country_id);
$('#city').val(data.result[0].address.city);
$('#state_or_province').val(data.result[0].address.state);
$('#vehicle_registration').val(data.result[0].vehicle_registration);
$('#Vehicle_identification_number').val(data.result[0].Vehicle_identification_number);


$('#status').val(data.result[0].status);
$('#hidden_id').val(id);
$('#hidden_address_id').val(data.result[0].address_id);
$('.modal-title').text('Order View, Code: '+data.result[0].code);
$('#action_button').text('Approve');
$('#action').val('approve');
$('#submit').removeClass('btn-outline-orange');
$('#submit').addClass('btn-outline-purple');


$('#create').modal('show');
}
})
});
function approveCancel(id){
    Swal.fire({
        title: "Are you sure?",
        html:"You won't be able to revert this!<br /><b><span class='text-success'> Approve this propose </span> OR <span class='text-danger'> Cancel this propose </span>",
        icon: "warning",
        showDenyButton: true,
        showCancelButton: true,
        // confirmButtonColor: "#3085d6",
        // cancelButtonColor: "#d33",
        confirmButtonText: "Approve!",
        cancelButtonText: "Close!",
        denyButtonText: "Cancel!",
    })
    .then((result) => {
    // Send request to the server

            if (result.isConfirmed) {
                let approve = 'approve';
            $.ajax({
            url: "/order/aprove-cancel/" + id,
            method:'POST',
            dataType:"json",
            data:{approve: approve},
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
            } else if (result.isDenied) {
                console.log('dfsafsd')
                let approve = 'cancel';
                $.ajax({
                url: "/order/aprove-cancel/" + id,
                method:'POST',
                dataType:"json",
                data:{approve: approve},
                success:function(data){

                if(data.errors) {
                swal("Failed!", "There was something wronge.", "warning");
                }

                if(data.success){

                $('#myTable').DataTable().ajax.reload();

                toast.fire({
                icon: "info",
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
$('#house_id ').val(id);
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

method:"POST",
data:new FormData(this),
dataType:'JSON',
contentType: false,
cache: false,
processData: false,
success:function(data)
{

    if(data.errors) {
    if(data.errors.cover_image){

    $('#cover_image').addClass('rounded-right');
    $('#cover_image').addClass('is-invalid');
    $( '#error_cover_image' ).text( data.errors.cover_image[0] );
    }
    if(data.errors.proof_of_property){

    $('#proof_of_property').addClass('rounded-right');
    $('#proof_of_property').addClass('is-invalid');
    $( '#error_proof_of_property' ).text( data.errors.proof_of_property[0] );
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

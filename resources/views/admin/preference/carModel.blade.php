@extends('admin.layout.app')
@section('page-title')
All Car model |
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span>Car Model List
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
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"
                            id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Year</th>
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
@section('modal-content')
@include('pages.modal.car_model')
@endsection
@endsection



@push('scripts')
<script>
    $(document).ready( function () {

    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        // responsive: {
        // details: {
        // display: $.fn.dataTable.Responsive.display.modal( {
        // header: function ( row ) {
        // var data = row.data();
        // console.log(data);
        // return 'Details for '+data['name'];
        // }
        // } ),
        // renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
        // tableClass: 'table'
        // } )
        // }
        // },

        ajax: '{!! route("admin.get.all.car.model") !!}',
        columns:[
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
            {data: 'brand', name: 'brand'},
            {data: 'model', name: 'model'},
            {data: 'vehicle_type', name: 'vehicle_type'},
            {data: 'year', name: 'year'},
            {data: 'created_at',  name: 'created_at'},
            {data:'updated_at', name: 'updated_at'}
    ]
    });


    $('#create_record').click(function(){
    $('.modal-title').text('Add New plan');
    $('#action_button').text('Save');
    $('.modal-header').addClass('bg-dark');
    $('#modal-icon').html('<i class="fa fa-plus" aria-hidden="true"></i>');
    $('#action').val('Add');
    $('#exit_flag').text("");
        $("#car_model_form")[0].reset();
        // remove the error text
        $(".text-danger").remove();

        $()

    $('#create').modal('show');

    });

    $('#car_model_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('car.model.store') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id = $('#hidden_id').val();
        action_url = '/admin/car-model/update/'+id;
    }

    $.ajax({
    url: action_url,
    method:"POST",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success:function(data)
    {
$('#error_brand').text(''); $('#brand').removeClass('is-invalid'); $('#brand').addClass('is-valid');
$('#error_model').text(''); $('#model').removeClass('is-invalid'); $('#model').addClass('is-valid');
$('#error_vehicle_type').text(''); $('#vehicle_type').removeClass('is-invalid'); $('#vehicle_type').addClass('is-valid');
$('#error_year').text(''); $('#year').removeClass('is-invalid'); $('#year').addClass('is-valid');






        if(data.errors) {
            if(data.errors.brand){

                $('#brand').addClass('rounded-right');
                $('#brand').addClass('is-invalid');
                $( '#error_brand').text( data.errors.brand[0] );
             }
            if(data.errors.brand){

                $('#model').addClass('rounded-right');
                $('#model').addClass('is-invalid');
                $( '#error_model').text( data.errors.brand[0] );
            }
            if(data.errors.model){

                $('#model').addClass('rounded-right');
                $('#model').addClass('is-invalid');
                $( '#error_model').text( data.errors.model[0] );
            }
            if(data.errors.vehicle_type){

                $('#vehicle_type').addClass('rounded-right');
                $('#vehicle_type').addClass('is-invalid');
                $( '#error_vehicle_type').text( data.errors.vehicle_type[0] );
            }
            if(data.errors.year){

                $('#year').addClass('rounded-right');
                $('#year').addClass('is-invalid');
                $( '#error_year').text( data.errors.year[0] );
            }
        }

        if(data.success){
            $('#create').modal('hide');

            $('#car_model_form')[0].reset();

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
url :"/admin/car-model/edit/"+id,
methode:"GET",
dataType:"json",
success:function(data)
{

$('#brand').val(data.result.brand);
$('#model').val(data.result.model);
$('#vehicle_type').val(data.result.vehicle_type);
$('#year').val(data.result.year);





$('#hidden_id').val(id);

$('.modal-title').text('Edit Record');
$('#action_button').text('Save change');
$('#action').val('Edit');
$('.modal-header').removeClass('bg-dark');
$('.modal-header').addClass('bg-warning');
$('#create').modal('show');
}
})
});
function deletePlan(id){
    Swal.fire({
        title: "Are you sure?",
        html:"You won't be able to revert this!<br /><b><span style='color:red;'> Delete gear box: </span>",
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
                url: "/admin/car-model/delete/" + id,
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



</script>
@endpush

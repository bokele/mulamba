@extends('admin.layout.app')
@section('page-title')
All Country |
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span> Country List
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
                                    <th scope="col">Flag</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Currency </th>

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
@include('pages.modal.country')
@endsection
@endsection



@push('scripts')
<script>
    $(document).ready( function () {
        $('#flag_of_feature').summernote();
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

        ajax: '{!! route("admin.get.all.country") !!}',
        columns:[
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
            // {data: 'code', name: 'code'},
            {data: 'flag', name: 'flag', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'code', name: 'code'},
            {data: 'currency', name: 'currency'},

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
        $("#country_form")[0].reset();
        // remove the error text
        $(".text-danger").remove();

        $()

    $('#create').modal('show');

    });

    $('#country_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('country.store') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id = $('#hidden_id').val();
        action_url = '/admin/country/update/'+id;
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
$('#error_name').text(''); $('#name').removeClass('is-invalid'); $('#name').addClass('is-valid');
$('#error_flag').text(''); $('#flag').removeClass('is-invalid'); $('#flag').addClass('is-valid');
$('#error_code').text('');$('#code').removeClass('is-invalid'); $('#code').addClass('is-valid');
$('#error_currency').text('');$('#currency').removeClass('is-invalid'); $('#currency').addClass('is-valid');




        if(data.errors) {
            if(data.errors.name){

                $('#name').addClass('rounded-right');
                $('#name').addClass('is-invalid');
                $( '#error_name' ).text( data.errors.name[0] );
             }
            if(data.errors.flag){

                $('#flag').addClass('rounded-right');
                $('#flag').addClass('is-invalid');
                $( '#error_flag' ).text( data.errors.flag[0] );
             }
             if(data.errors.code){

            $('#code').addClass('rounded-right');
            $('#code').addClass('is-invalid');
            $( '#error_code' ).text( data.errors.code[0] );
            }
             if(data.errors.code){

            $('#currency').addClass('rounded-right');
            $('#currency').addClass('is-invalid');
            $( '#error_currency' ).text( data.errors.currency[0] );
            }





        }

        if(data.success){
            $('#create').modal('hide');

            $('#country_form')[0].reset();

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
url :"/admin/country/edit/"+id,
methode:"GET",
dataType:"json",
success:function(data)
{
$('#exit_flag').text("");
$('#name').val(data.result.name);
$('#exit_flag').text(data.result.flag)
$('#code').val(data.result.code)
$('#currency').val(data.result.currency)



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
        html:"You won't be able to revert this!<br /><b><span style='color:red;'> Delete Country: </span>",
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
                url: "/admin/country/delete/" + id,
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

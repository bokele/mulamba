@extends('admin.layout.app')
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
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="myTable">
                            <thead class="thead-dark">
                                <tr>

                                    <th scope="col">Actions</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">updated</th>
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

@section('modal-content')
@include('admin.modal.user_modal')
@endsection
@push('scripts')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        ajax: '{!! route("admin.get.all.users") !!}',
        columns:[
            {data: 'actions', name: 'actions'},
            {data: 'status', name: 'status'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'type', name: 'type'},
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

    $('#create').modal('show');

    });

    $('#user_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('admin.user.create') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id_user = $('#hidden_id').val();
        action_url = '/admin/user/update/'+id_user;
    }

    $.ajax({
    url: action_url,
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    success:function(data)
    {

        if(data.errors) {
            if(data.errors.user_full_name){

                $('#user_full_name').addClass('rounded-right');
                $('#user_full_name').addClass('is-invalid');
                $( '#full_name' ).text( data.errors.user_full_name[0] );
             }
             if(data.errors.user_email){

            $('#user_email').addClass('rounded-right');
            $('#user_email').addClass('is-invalid');
            $( '#email' ).text( data.errors.user_email[0] );
            }
            if(data.errors.type){

            $('#type').addClass('rounded-right');
            $('#type').addClass('is-invalid');
            $( '#error_type' ).text( data.errors.type[0] );
            }
            if(data.errors.user_status){

            $('#user_status').addClass('rounded-right');
            $('#user_status').addClass('is-invalid');
            $( '#status' ).text( data.errors.user_status[0] );
            }
            if(data.errors.user_gender){

            $('#user_gender').addClass('rounded-right');
            $('#user_gender').addClass('is-invalid');
            $( '#gender' ).text( data.errors.user_gender[0] );
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
url :"/admin/user/"+id+"/edit",
dataType:"json",
success:function(data)
{
$('#user_full_name').val(data.result.name);
$('#user_email').val(data.result.email);
$('#user_type').val(data.result.user_type);
$('#user_status').val(data.result.status);
$('#user_gender').val(data.result.gender);
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
function deleteUser(id){
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
                url: "/admin/user/delete/" + id,
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

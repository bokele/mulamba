@extends('admin.layout.app')
@section('page-title')
All plan |
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span> Plan List
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
                                    {{-- <th scope="col">code</th> --}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Cost </th>
                                    <th scope="col">Stripe plan </th>

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
@include('pages.modal.plan')
@endsection
@endsection



@push('scripts')
<script>
    $(document).ready( function () {
        $('#description_of_feature').summernote();
    $('#myTable').DataTable({
        processing: true,
        serverside:true,
        ajax: '{!! route("admin.get.all.plan") !!}',
        columns:[
            {data: 'actions', name: 'actions'},
            // {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {data: 'cost', name: 'cost'},
            {data: 'stripe_plan', name: 'stripe_plan'},
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

        $("#plan_form")[0].reset();
        // remove the error text
        $(".text-danger").remove();

        $()

    $('#create').modal('show');

    });

    $('#plan_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('plan.store') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id = $('#hidden_id').val();
        action_url = '/admin/plan/update/'+id;
    }

    $.ajax({
    url: action_url,
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    success:function(data)
    {
$('#error_name').text(''); $('#name').removeClass('is-invalid'); $('#name').addClass('is-valid');
$('#error_description').text(''); $('#description').removeClass('is-invalid'); $('#description').addClass('is-valid');
$('#error_cost').text('');$('#cost').removeClass('is-invalid');
$('#cost').addClass('is-valid');




        if(data.errors) {
            if(data.errors.name){

                $('#name').addClass('rounded-right');
                $('#name').addClass('is-invalid');
                $( '#error_name' ).text( data.errors.name[0] );
             }
            if(data.errors.description){

                $('#description').addClass('rounded-right');
                $('#description').addClass('is-invalid');
                $( '#error_description' ).text( data.errors.description[0] );
             }
             if(data.errors.cost){

            $('#cost').addClass('rounded-right');
            $('#cost').addClass('is-invalid');
            $( '#error_cost' ).text( data.errors.cost[0] );
            }





        }

        if(data.success){
            $('#create').modal('hide');

            $('#plan_form')[0].reset();

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
url :"/admin/edit/"+id,
methode:"GET",
dataType:"json",
success:function(data)
{
    console.log(data)
$('#name').val(data.result.name);
$('#description').val(data.result.description)
$('#cost').val(data.result.cost)



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
        html:"You won't be able to revert this!<br /><b><span style='color:red;'> Delete Plan: </span>",
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
                url: "/admin/plan/delete/" + id,
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

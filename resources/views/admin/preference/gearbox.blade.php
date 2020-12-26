@extends('admin.layout.app')
@section('page-title')
All gear box |
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="card card-blue">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="fa fa-list"></span> Gear box List
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
                                    <th scope="col">Name</th>
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
@include('pages.modal.gear_box')
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

        ajax: '{!! route("admin.get.all.gear.box") !!}',
        columns:[
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
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
        $("#gear_box_form")[0].reset();
        // remove the error text
        $(".text-danger").remove();

        $()

    $('#create').modal('show');

    });

    $('#gear_box_form').on('submit', function(event){
    event.preventDefault();
    let action_url = '';

    if($('#action').val() == 'Add')
    {
    action_url = "{{ route('gear.box.store') }}";
    }

    if($('#action').val() == 'Edit')
    {
        var id = $('#hidden_id').val();
        action_url = '/admin/gear-box/update/'+id;
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





        if(data.errors) {
            if(data.errors.name){

                $('#name').addClass('rounded-right');
                $('#name').addClass('is-invalid');
                $( '#error_name' ).text( data.errors.name[0] );
             }
        }

        if(data.success){
            $('#create').modal('hide');

            $('#gear_box_form')[0].reset();

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
url :"/admin/gear-box/edit/"+id,
methode:"GET",
dataType:"json",
success:function(data)
{

$('#name').val(data.result.name);




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
                url: "/admin/gear-box/delete/" + id,
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

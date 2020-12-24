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
                                    <th scope="col">Payment Code</th>
                                    <th scope="col">Order Code</th>

                                    <th scope="col">Owner</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Sold Price</th>
                                    <th scope="col">Amount Paid</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Stripe code</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Created at</th>
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

@section('modal-content-view')
@include('pages.modal.payment-view-detail')
@endsection




@push('javascripts')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            processing: true,
            serverside:true,
            ajax: '{!! route("finance.management.get.all.payment") !!}',
            columns:[
                {data: 'actions', name: 'actions'},
                {data: 'status', name: 'status'},
                {data: 'reference_code', name: 'reference_code'},
                {data: 'order_code', name: 'order_code'},
                {data: 'owner', name: 'owner'},
                {data: 'customer',  name: 'customer'},
                {data: 'sold_price', name: 'sold_price'},
                {data: 'amount_paid', name: 'amount_paid'},
                {data: 'currency', name: 'currency'},
                {data: 'payment_code', name: 'payment_code'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at',  name: 'updated_at'},

            ]
        });

    });

$(document).on('click', '.show', function(){
var id = $(this).attr('id');
$.ajax({
url :"/finance-management/payment/get-payment/"+id+"/show",
methode:"GET",
dataType:"json",
success:function(data)
{

$('#order_reference').val(data.order.code);
$('#payment_reference').val(data.ref_number);
$('#total_amount_paid').val(data.amount_paid);
$('#max_price').val(data.sold_price);
$('#status').val(data.status);
$('#method').val(data.method);
$('#customer_name').val(data.customer.name);
$('#customer_email').val(data.customer.email);
$('#owner_name').val(data.owner.name);
$('#owner_email').val(data.owner.email);
$('#stripe_code').val(data.payment_code);



$('.modal-title').text('Payment detail');


$('#view').modal('show');
}
})
});





</script>
@endpush

@extends('layouts.layout')

@section('page-title')
Boutiques | Cars |

@endsection
@section('page-subtitle')
Cars

@endsection
@section('title-link')
<li>boutiques</li>
<li>car</li>
@endsection
@section('content')
<div class="section-title" data-aos="fade-up">
    <h2 class="font-weight-bold text-uppercase text-orange"><strong>Car for Sale and Let</strong></h2>
</div>
<div class="col-md-12">

    <div class="row" id="boutique-car">

        @include('pages.car.car_pagination_data')

    </div>

</div>
@endsection
@section('javascript')

<script type='text/javascript'>
    $(document).ready(function(){

$(document).on('click', '.pagination a', function(event){
event.preventDefault();
var page = $(this).attr('href').split('page=')[1];
fetch_data(page);
});

function fetch_data(page)
{
$.ajax({
url:"/boutique/car/data?page="+page,
success:function(data)
{
$('#boutique-car').html(data);
}
});
}

});

</script>
@endsection

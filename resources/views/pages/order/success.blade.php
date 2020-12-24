@extends('layouts.layout')

@section('page-title')
Boutiques | Order | Success

@endsection
@section('page-subtitle')
Order success

@endsection
@section('title-link')
<li><a href="#">boutiques</a></li>
{{-- <li><a href="{{route('boutiques.car.detail')}}">Order</a></li> --}}
<li>success</li>

@endsection
@section('content')
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Well done!</h4>

    <p>{{ $message }}</p>


    <hr>
    <p class="mb-0">
        Your will receive a email when your propose price is approve For the payment


    </p>
</div>
@endsection

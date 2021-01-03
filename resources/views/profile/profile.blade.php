@extends('layouts.app')
@section('page-title')
Profile
@endsection
@section('page_hero')
<section class="d-flex align-items-center ">
    <div class="container">
        <div class="row text-center mt-5">
            {{-- <h1 class="text-center"><span class="text-technosoft">Profile</span><span class="text-primary"></h1> --}}
        </div>
    </div>
</section>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($message = Session::get('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <strong class="text-cenetr"> {{$message}}</strong>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        @endif

        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline mb-3">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{asset(Auth::user()->profile_photo_path)}}" alt="User profile picture">
                    </div>

                    <h4 class="profile-username text-center">{{Auth::user()->name}}</h4>

                    <p class="text-muted text-center">{{Auth::user()->email}}</p>




                    <a class="btn btn-danger btn-block" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>


                        <i class="icofont-logout"></i> Logout


                    </a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


        </div>

        <div class="col-md-9 mb-3">
            <div class="card">
                <div class="card-header p-2 bg-dark">

                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link text-white @if (\Route::current()->getName() == 'user.profile') active @endif"
                                href="{{ route('user.profile') }}">General
                                Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white @if (\Route::current()->getName() == 'user.profile.change.password') active @endif"
                                href="{{ route('user.profile.change.password') }}">Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white @if (\Route::current()->getName() == 'user.profile.change.picture') active @endif"
                                href="{{ route('user.profile.change.picture') }}">change Picture</a>
                        </li>

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    @if (\Route::current()->getName() == 'user.profile')
                    @include('profile.setting')
                    @elseif (\Route::current()->getName() == 'user.profile.change.password')
                    @include('profile.password')
                    @elseif (\Route::current()->getName() == 'user.profile.change.picture')
                    @include('profile.picture')
                    @endif
                </div>
            </div>
            <!-- /.row -->


        </div>
        @endsection
        @section('javascript')
        <script type="text/javascript">
            function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(id)
                            .attr('src', e.target.result)
                            .width(200)
                            .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
         }
        </script>
        @endsection

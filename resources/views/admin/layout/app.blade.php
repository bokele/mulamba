<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') {{ config('app.name', 'Laravel') }} </title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">




    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet">


</head>
@section('body_class','hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed')
@section('body_wrapper','wrapper')

<body class="@yield('body_class')">
    <div id="app" class="@yield('body_wrapper')">


        @guest
        @include('pages.notFound')
        @else
        @can('isAdmin')
        @include('admin.includes.header')
        @include('admin.includes.sidebar')

        <div class="content-wrapper">
            <div class="content">
                <div class="container">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">@yield('page-title')</h1>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item">
                                            <a href="/home">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">@yield('page-title')</li>
                                    </ol>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    @yield('content')
                    @include('admin.modal.create')
                    @include('admin.modal.attachment')
                </div>
            </div>
        </div>
        @include('admin.includes.footer')
    </div>
    @endcan
    @endguest
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <script>
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    </script>

    @stack('scripts')
</body>





</html>

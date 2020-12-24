<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon_io/site.webmanifest') }}">
    <link href="{{ asset("assets/img/apple-touch-icon.png") }}" rel="apple-touch-icon" />

    <title>{{ config('app.name', 'Technosoft') }} | Login</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .login-logo img {
            max-width: 100%;
            max-height: 100px;

        }
    </style>
</head>

<body class="hold-transition login-page bg-purple">
    <div id="app" class="login-box">
        <div class="login-logo">


            <a href="{{ url('/' )}}"> <img src="{{ asset('logo.png')}}" class="img-fluid mx-auto d-block"
                    alt="logo mulamba" /></a>

        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg text-purple font-weight-bolder">Sign in to start your session</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="input-group mb-3">
                                <input id="email" type="email" placeholder="E-mail"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group mb-3">
                                <input id="password" type="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-purple form-control">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- /.social-auth-links -->
                    <p class="mb-1">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link text-purple" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                        <a href="{{ url('/register')}}"
                            class="text-center text-purple font-weight-bolder">{{ __('Register') }}</a>
                    </p>

            </div>
        </div>
    </div>
    {{-- <div class="left login-logo">
        <h4> <a href="wwww.Technosoft.co.zm"> Powered By Technosoft</a></h4>
    </div> --}}
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>

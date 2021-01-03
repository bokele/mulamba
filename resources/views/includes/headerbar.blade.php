{{-- <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i><a href="mailto:contact@example.com">contact@example.com</a>
            <i class="icofont-phone"></i> +1 5589 55488 55
        </div>
        <div class="social-links">
            <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="#" class="skype"><i class="icofont-skype"></i></a>
            <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
        </div>
    </div>
</section> --}}
<header id="header">
    <div class="container d-flex">

        <div class="logo mr-auto clearfix">
            {{-- <h1 class="text-light"><a href="/">{{ config('app.name', 'Laravel') }}</a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="/">
                <img src="{{ asset('logo.png')}}" alt="mulamba logo" class="img-fluid  float-left" />
                <h1 class="font-weight-bolder text-purple ml-2">{{ config('app.name', 'Laravel') }}</h1>
            </a>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li><a href="/">Home</a></li>
                {{-- <li><a href="{{ route('boutiques') }}">Boutiques</a></li> --}}
                <li class="drop-down"><a href="">Boutiques</a>
                    <ul>
                        <li><a href="{{route('car.get')}}">Cars</a></li>

                        <li><a href="#">Houses coming soon</a></li>
                        <li><a href="#">Estates coming soon</a></li>

                    </ul>
                </li>
                <li><a href="{{route('about')}}">About</a></li>
                <li><a href="{{route('services')}}">Services</a></li>
                <li><a href="{{route('pricing')}}">Pricing</a></li>
                <li><a href="blog.html">Partner</a></li>

                <li><a href="contact.html">Contact</a></li>





                @if (Route::has('login'))

                @auth
                <li> <a href="{{ url('/home') }}" class="login btn btn-outline-purple btn-md ml-2 mr-2 mt-2"
                        role="button" aria-pressed="true">Dashbord</a></li>

                @else
                <li> <a href="{{ route('login') }}" class="login btn btn-outline-orange btn-md ml-2 mr-2 mt-2"
                        role="button" aria-pressed="true">Login</a></li>

                @if (Route::has('register'))
                <li> <a href="{{ route('register') }}" class="register btn btn-purple btn-md active ml-2 mr-2 mt-2 "
                        role="button" aria-pressed="true">Register</a></li>
                @endif
                @endauth
            </ul>
        </nav><!-- .nav-menu -->
        @endif
    </div>
</header>

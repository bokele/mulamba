<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">



    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a href="/home" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>

        </ul>


    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">

                <img src="{{ asset(Auth::user()->profile_photo_path)}}" alt="User Avatar"
                    class="img-size-50 img-circle mr-3">


            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="/user/profile" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">

                        <img src="{{ asset(Auth::user()->profile_photo_path)}}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">


                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{Auth::user()->name}}

                            </h3>
                            <p class="text-sm">{{Auth::user()->email}}</p>
                            <p class="text-sm text-muted"> Join
                                {{  date('d-m-Y H:m:i', strtotime(Auth::user()->created_at))}} </p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <div class="user-footer">
                    <div class="float-left">
                        <a class=" btn  btn-outline-danger btn-sm ml-2 mt-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off "></i>
                            <span class="text-sm  "> {{ __('Logout') }}</span>


                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div class="float-right">
                        <a href="/user/profile" class="btn  btn-outline-primary btn-sm mr-2 mt-1"> <i
                                class="nav-icon fa fa-user"></i> Profile</a>
                    </div>
                </div>
            </div>

        </li>
    </ul>

</nav>

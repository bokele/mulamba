<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"> {{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-5 pb-3 mb-3 d-flex">
            <div class="image mt-3">
                @if(Auth::user()->profile_photo_path != "")
                <img src="{{Auth::user()->profile_photo_path}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                @else
                @if(Auth::user()->gender == 'Male')
                <img src="/images/male-placeholder.jpeg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                @else
                <img src="/images/female-placeholder.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                @endif
                @endif
            </div>
            <div class="info mt-3">
                <a href="#" class="d-block">
                    {{Auth::user()->first_name." ".Auth::user()->last_name}}
                    <p>{{Auth::user()->email}}
                        {{Auth::user()->job}}
                    </p>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <li class="nav-item">
                    <a href="/home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/user/profile" class="nav-link">
                        <i class="nav-icon fas fa-user orange"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/mailbox/inbox" class="nav-link ">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/mailbox/resquest" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Request</p>
                            </a>
                        </li>

                    </ul>
                </li>





                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cash-register"></i>
                        <p>
                            Finance Management
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/finance-management/orders" class="nav-link">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ route('finance.management.payment') }}" class="nav-link">
                            <i class="fa fa-hand-holding-usd nav-icon"></i>
                            <p>Payment</p>
                            </a> --}}
                        </li>
                        <li class="nav-item">
                            <a href="/list-invoice" class="nav-link">
                                <i class="fa fa-file-invoice-dollar nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('finance.management.payment') }}" class="nav-link">
                                <i class="fa fa-hand-holding-usd nav-icon"></i>
                                <p>Payment</p>
                            </a>
                        </li>/a>
                </li>

            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

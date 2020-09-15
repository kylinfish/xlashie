@include('layouts.head')

<body>
    <div class="main-content" id="panel">
        <nav class="navbar fixed-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <a href="/" class="text-white h2 mr-3 mt-2">Venus CRM </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ auth()->user()->avatar }}">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Good Day!</h6>
                                </div>
                                <a href="#!" class="dropdown-item disabled">
                                    <i class="ni ni-single-02"></i>
                                    <span>帳號資料</span>
                                </a>
                                <a href="#!" class="dropdown-item disabled">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>設定</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="/auth/logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>登出</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid mt-7">
            @yield('content')
        </div>
    </div>
    @include('layouts.foot')
</body>

</html>

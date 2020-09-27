@include('layouts.head')

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-5 py-lg-7">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">{{ $company->name }} </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-5">
                                <p>使用第三方社群登入在</p>
                                <p class="pt-1 pb-1 h3  ">{{ $company->name}}</p>
                                <p>建立會員資料吧 !</p>
                            </div>
                            <div class="text-center">
                                <a href="/" class="btn btn-neutral btn-icon mr-4">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/github.svg"></span>
                                    <span class="btn-inner--text">Facebook</span>
                                </a>
                                <a href="/customer/register/google/{{$company->en_name}}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

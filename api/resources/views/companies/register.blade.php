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
                            <h1 class="text-white">{{ $company->name }}</h1>
                            <span class="text-white">會員資料填寫</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>

        <div class="container mt--7 pb-5">
            <form class="card col-lg-6 offset-lg-3" action="/company/{{$company->en_name}}/register" method="POST">
                <div class="card-body">
                    <div class="row justify-content-center mb-6">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <img src="{{ $customer->avatar ?: '../../assets/img/theme/team-3.jpg'}}" class="rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 名字</label>
                            <input type="text" class="form-control" name="name" value="{{ $customer->name ?: '' }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">手機</label>
                            <input type="cellphone" class="form-control" name="cellphone">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">地址</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">生日</label>
                            <input type="date" class="form-control" name="birth">
                        </div>
                    </div>
                    <input type="hidden" name="uuid" value="{{ $customer->uuid ?? '' }}">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
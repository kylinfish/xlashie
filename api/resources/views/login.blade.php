@include('layouts.head')

<body class="bg-default">
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-lg-7">
            <div class="container">
                <div class="header-body text-center mb-lg-7 mb-md-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">歡迎 Venus!</h1>
                            <p class="text-lead text-white">登入開始輕鬆客戶經營之旅</p>
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

        <div class="container mt-lg--8 mt-md--5 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-4">
                            <div class="text-muted text-center mt-2 mb-3"><small>使用第三方登入驗證</small></div>
                            <div class="btn-wrapper text-center">
                                <a href="/login/facebook" class="btn btn-neutral btn-icon disabled">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/github.svg"></span>
                                    <span class="btn-inner--text">Facebook</span>
                                </a>
                                <a href="/login/google" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" method="POST" action="/login">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="email" type="email" value="admin@a.com" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="admin" required>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="remember_token" name="remember_token" type="checkbox" checked>
                                    <label class="custom-control-label" for="remember_token">
                                        <span class="text-muted">記住我</span>
                                    </label>

                                    @error('status')
                                        <span class="text-danger float-right">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">登入</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="#" class="text-light" disabled><small>忘記密碼?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/auth/register/" class="text-light"><small>建立新帳號</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="微型企業CRM，個人工作室、斜槓族、開店創業者的經營最佳幫手，客戶管理、會員經營、智慧儀表雲端系統。Slashie, SOHO, Xlashie">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/img/brand/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>XLASHIE 微圈 - 會員登入</title>

    <meta name="keywords" content="微型企業, XLASHIE, Slashie, CRM, Dashboard, Excel, ERP, 斜槓事業的最佳幫手, 客戶管理, 會員經營, 智慧儀表">
    <meta name="description" content="微型企業CRM，個人工作室、斜槓族、開店創業者的經營最佳幫手，客戶管理、會員經營、智慧儀表雲端系統。Slashie, SOHO, Xlashie">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="XLASHIE 微圈 - 微型企業 CRM">
    <meta itemprop="description" content="微型企業CRM，個人工作室、斜槓族、開店創業者的經營最佳幫手，客戶管理、會員經營、智慧儀表雲端系統。Slashie, SOHO, Xlashie">
    <meta itemprop="image" content="assets/img/theme/landing-0.png">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:title" content="XLASHIE 微圈 - 微型企業 CRM">
    <meta name="twitter:description" content="微型企業CRM，個人工作室、斜槓族、開店創業者的經營最佳幫手，客戶管理、會員經營、智慧儀表雲端系統。Slashie, SOHO, Xlashie">
    <meta itemprop="twitter:image" content="assets/img/theme/landing-0.png">
    <!-- Open Graph data -->
    <meta property="og:title" content="XLASHIE 微圈 - 微型企業 CRM" />
    <meta property="og:type" content="article" />

    <meta property="og:description" content="微型企業CRM，個人工作室、斜槓族、開店創業者的經營最佳幫手，客戶管理、會員經營、智慧儀表雲端系統。Slashie, SOHO, Xlashie" />
    <meta property="og:site_name" content="XLASHIE 微圈 - 微型企業 CRM" />
    <link rel="icon" href="./assets/img/brand/ico.png" type="image/png">


    <link rel="icon" href="{{ asset('/img/brand/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/brand/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/brand/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/brand/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/brand/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/brand/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/brand/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/brand/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/brand/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/brand/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/brand/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/brand/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/brand/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/brand/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/brand/manifest.json">

    <link rel="stylesheet" href="{{ mix('css/main.css') }}" type="text/css">
    @include('common.ga')
</head>

<body class="bg-default">
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-lg-5 py-md-4">
            <div class="container">
                <div class="header-body text-center mb-lg-6 mb-md-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 py-4">
                            <h1 class="text-white">
                                <a href="/" class="text-yellow"> <b>XLASHIE</b></a>
                            </h1>
                            <img class="mx-auto d-block" src="/assets/img/brand/logo-white.png" width="25%">
                            <p class="mt-4 text-white">經營客戶就是動動手指這麼簡單</p>
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

        <div class="container mt-lg--8 mt-md--4 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-4">
                            <div class="text-muted text-center mt-2 mb-3"><small>使用第三方登入驗證</small></div>
                            <div class="btn-wrapper text-center">
                                <!--<a href="/login/facebook" class="btn btn-neutral btn-icon disabled">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/github.svg"></span>
                                    <span class="btn-inner--text">Facebook</span>
                                </a>-->
                                <a href="/login/google?type=user" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img
                                            src="../../assets/img/icons/common/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <!--
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Preview 尚未開放正式註冊，請先使用社群登入</small>
                            </div>
                            <form role="form" method="POST" action="/login">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" name="email" type="email" required disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" name="password" type="password" disabled>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="remember_token" name="remember_token" type="checkbox" checked disabled>
                                    <label class="custom-control-label" for="remember_token">
                                        <span class="text-muted">記住我</span>
                                    </label>

                                    @error('status')
                                        <span class="text-danger float-right">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4" disabled>登入</a>
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
                -->
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
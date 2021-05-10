<nav id="navbar-main" class="navbar navbar-horizontal navbar-main navbar-expand-lg navbar-dark <?= (auth()->user()->is_demo) ? 'bg-danger' : 'bg-primary' ?>">
    <div class="container col-md-12">
        <a class="navbar-brand ml-5 mr--1" href="/home">
            <img src="{{ asset('/assets/img/brand/ico.png') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
            aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/home" class="navbar-brand text-dark">XLASHIE</a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav  mr-auto">
                <li class="nav-item">
                    <a href="/home" class="nav-link">
                        <span class="nav-link-inner--text">首頁</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/customers/" class="nav-link">
                        <span class="nav-link-inner--text"><i class="fas fa-users"></i> 客戶管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/orders/" class="nav-link">
                        <span class="nav-link-inner--text"><i class="fas fa-list"></i> 歷史訂單</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/" class="nav-link">
                        <span class="nav-link-inner--text"><i class="fas fa-tachometer-alt"></i> 圖表總覽</span>
                    </a>
                </li>
            </ul>


            <div class="dropdown-divider"></div>

            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                @if (auth()->user()->is_demo)
                <form action="/user/demo" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item text-white bg-danger"
                        data-toggle="tooltip" data-placement="bottom" title="點我回到自己的真實帳號">
                        <span class="badge badge-danger badge-lg mr-1">測試模式中...</span>
                        <span class="badge badge-primary mr-2">(請勿輸入敏感訊息，資訊將被其他人共用及瀏覽)</span>
                    </button>
                </form>
                @endif

                <div class="dropdown-divider d-none d-xs-block d-md-none"></div>

                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">

                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ auth()->user()->avatar }}">
                            </span>
                            <div class="media-body ml-2">
                                <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name}}</span>
                            </div>

                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title  d-none d-lg-block">
                            <h6 class="text-overflow m-0">今天好嗎!</h6>
                        </div>
                        @if (auth()->user()->is_demo)
                        <form action="/user/demo" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="dropdown-item bg-primary text-white">
                                <i class="ni ni-single-02"></i>
                                <b>回個人帳號</b>
                            </button>
                        </form>
                        @else
                        <form action="/user/demo" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa fa-gamepad"></i>
                                <span>前往測試模式</span>
                            </button>
                        </form>
                        @endif
                        <!---
                        <a href="#!" class="dropdown-item disabled">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>設定</span>
                        </a>-->
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

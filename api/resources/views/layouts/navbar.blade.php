<nav id="navbar-main" class="navbar navbar-horizontal navbar-main navbar-expand-lg navbar-dark bg-primary">
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

                <div class="dropdown-divider d-none d-xs-block d-md-none"></div>

                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ auth()->user()->avatar }}">
                            </span>
                            <div class="media-body  ml-2">
                                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title  d-none d-lg-block">
                            <h6 class="text-overflow m-0">今天好嗎!</h6>
                        </div>
                        <!--
                        <a href="#!" class="dropdown-item disabled">
                            <i class="ni ni-single-02"></i>
                            <span>帳號資料</span>
                        </a>
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

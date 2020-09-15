@extends('layouts.app')
@section('content')

<h1 class="text-center mt-3 mb-5">主選單</h1>

<section class="section section-lg pt-lg-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/company/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-store fa-4x"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">店家設定</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/customers/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-4x fa-users"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">客戶管理</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/products/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-4x fa-box-open"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">產品設定</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/menus/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-4x fa-bars"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">服務項目</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/dashboard/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-4x fa-chart-line"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">報表</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a class="card card-lift--hover shadow border-0" href="/calendar/">
                            <div class="card-body py-4 text-center">
                                <div class="text-primary mb-4">
                                    <i class="fas fa-4x fa-calendar-alt"></i>
                                </div>
                                <h4 class="h2 text-primary text-uppercase">行事曆</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

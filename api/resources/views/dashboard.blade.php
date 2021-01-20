@extends('layouts.app')
@section('content')
<div class="header pb-6">
    <div class="col-md">
        <div class="header-body">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">客戶數 / 訂單總數</h5>
                                    <span class="h2 font-weight-bold mb-0" id="totalOrders"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">總銷售金額</h5>
                                    <span class="h2 font-weight-bold mb-0" id="totalExpense"></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-chart-pie-35"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">最熱銷產品</h5>
                                    <span class="h2 font-weight-bold mb-0" id="topSaleProduct"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">訂單數量 (以日期區分)</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="chart-bars" class="chart-canvas chartjs-render-monitor" width="735" height="350"
                            style="display: block; width: 735px; height: 350px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">單品銷售次數</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <!-- Chart wrapper -->
                        <canvas id="chart-horizontal-bar" class="chart-canvas chartjs-render-monitor"
                            style="display: block; width: 735px; height: 350px;" width="735" height="350"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">支付方式佔比</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="chart-pie" class="chart-canvas chartjs-render-monitor" width="735" height="350"
                            style="display: block; width: 735px; height: 350px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js?v=1.2.0') }}"></script>
@endpush

@endsection

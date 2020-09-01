@extends('layouts.app')
@section('content')
<div class="header pb-6">
    <div class="col-md">
      <div class="header-body">
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">月營收趨勢</h5>
                    <span class="h2 font-weight-bold mb-0">350,897</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="ni ni-active-40"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                    <span class="h2 font-weight-bold mb-0">2,356</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="ni ni-chart-pie-35"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                    <span class="h2 font-weight-bold mb-0">924</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-money-coins"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                    <span class="h2 font-weight-bold mb-0">49,65%</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="ni ni-chart-bar-32"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p>
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
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Overview</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">總營收成長趨勢</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-sales" class="chart-canvas chartjs-render-monitor" width="735" height="350" style="display: block; width: 735px; height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Performance</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">熱賣產品銷售量</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-bars" class="chart-canvas chartjs-render-monitor" width="735" height="350" style="display: block; width: 735px; height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Growth</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">客戶成長比</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-points" class="chart-canvas chartjs-render-monitor" width="735" height="350" style="display: block; width: 735px; height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Users</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">消費頻率分布</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-doughnut" class="chart-canvas chartjs-render-monitor" width="735" height="350" style="display: block; width: 735px; height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Partners</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">總營收占比</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-pie" class="chart-canvas chartjs-render-monitor" width="735" height="350" style="display: block; width: 735px; height: 350px;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <!--* Card header *-->
        <!--* Card body *-->
        <!--* Card init *-->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <!-- Surtitle -->
            <h6 class="surtitle">Overview</h6>
            <!-- Title -->
            <h5 class="h3 mb-0">Product comparison</h5>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
              <!-- Chart wrapper -->
              <canvas id="chart-bar-stacked" class="chart-canvas chartjs-render-monitor" style="display: block; width: 735px; height: 350px;" width="735" height="350"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center  text-lg-left  text-muted">
            © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
@endsection

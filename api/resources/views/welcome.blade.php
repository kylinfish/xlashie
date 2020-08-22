@extends('layouts.app')
@section('content')

<h1 class="text-center mt-5 mb-5">主選單</h1>

<section class="section section-lg pt-lg-0">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-4">
                <a class="card card-lift--hover shadow border-0" href="/company/">
                  <div class="card-body py-5 text-center">
                    <div class="text-primary mb-4">
                      <i class="fas fa-store fa-7x"></i>
                    </div>
                    <h4 class="h2 text-primary text-uppercase">店家設定</h4>
                  </div>
                </a>
              </div>
              <div class="col-lg-4">
                <a class="card card-lift--hover shadow border-0" href="/customers/">
                  <div class="card-body py-5 text-center">
                    <div class="text-primary mb-4">
                      <i class="fas fa-7x fa-users"></i>
                    </div>
                    <h4 class="h2 text-primary text-uppercase">客戶管理</h4>
                  </div>
                </a>
              </div>
              <div class="col-lg-4">
                <a class="card card-lift--hover shadow border-0" href="/products/">
                  <div class="card-body py-5 text-center">
                    <div class="text-primary mb-4">
                      <i class="fas fa-7x fa-box-open"></i>
                    </div>
                    <h4 class="h2 text-primary text-uppercase">產品設定</h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


@endsection
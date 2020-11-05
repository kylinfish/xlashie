@extends('layouts.app')
@section('content')
@include('common.alert')

<section class="section section-lg pt-lg-0">
    <div class="container">
        <div class="row justify-content-center">
            @if ($customer_count != 0)
            <div class="col-lg-12 mt-3 mb-3">
                @include('common.search')
            </div>
            @endif
            <div class="col-lg-6">
                <div class="table-default p-3 rounded shadow-sm mb-4">
                    @if ($customer_count == 0)
                        <h3>請先進行 <a class="text-primary" href="/customers/?wizard=1">客戶新增</a>，方可瀏覽近期交易紀錄</h3>
                    @else
                        <h3>近期交易紀錄</h3>
                        <div>
                        @if ($recently_tickets)
                            <ul class="list-group">
                                @foreach ($recently_tickets as $ticket)
                                <li class="list-group-item">
                                    <span class="float-left">金額: {{ $ticket->price }}</span>
                                    <span class="float-right">{{ $ticket->created_at }}</span></li>
                                @endforeach
                            </ul>
                        @else
                        <p class="pl-5 pt-2">最近沒有新的交易紀錄</p>
                        @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="table-primary p-3 rounded shadow-sm mb-4">
                <h3>功能選單</h3>
                <div class="row">
                    <div class="col-6">
                        <a class="card shadow border-0" href="/company/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"> <i class="fas fa-store"></i> 店家資訊</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="card shadow border-0" href="/menus/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"><i class="fas fa-bars"></i> 營業項目</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="card shadow border-0" href="/customers/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"><i class="fas fa-users"></i> 客戶管理</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="card shadow border-0" href="/dashboard/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-gray text-uppercase"> <i class="fas fa-chart-line"></i> 報表 <small>(預覽)</small></h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


@endsection

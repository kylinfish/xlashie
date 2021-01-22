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

            <div class="col-lg-6 ">
                <div class="table-primary p-3 rounded shadow-sm mb-4">
                    <h3>選單</h3>

                    <div class="col">
                        <a class="card shadow border-0" href="/menus/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"><i class="fas fa-cube"></i> 營業項目</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="card shadow border-0" href="/customers/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"><i class="fas fa-users"></i> 客戶管理</h4>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a class="card shadow border-0" href="/orders/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"> <i class="fas fa-bars"></i> 歷史訂單</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="card shadow border-0" href="/dashboard/">
                            <div class="card-body text-center">
                                <h4 class="h2 text-primary text-uppercase"> <i class="fas fa-tachometer-alt"></i> 圖表總覽
                                </h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

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
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="mb-0 text-gray">
                                            <a href="/customers/{{ $ticket->customer->uuid }}">
                                                {{ $ticket->customer->name }} <i
                                                    class="pl-1 fa fa-external-link-alt"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="col-4">
                                        <i class="text-primary fa fa-dollar-sign"></i>
                                        金額: {{ number_format($ticket->price) }}
                                    </div>
                                    <div class="col-3 text-center">
                                        <i class="text-success ni ni-calendar-grid-58"></i>
                                        <small>{{ $ticket->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p class="pl-5 pt-2">最近沒有新的交易紀錄</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

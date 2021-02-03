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
                                <h4 class="h2 text-primary text-uppercase"> <i class="fas fa-list"></i> 歷史訂單</h4>
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
                <div class="card p-3 rounded shadow-sm mb-4">
                    @if ($recently_tickets->count() == 0)
                    <h3>前往<a class="text-primary" href="/customers/">客戶資料頁</a>，開始你新的交易吧!</h3>
                    @else
                    <h3>近期交易紀錄</h3>
                    <div>
                        @if ($recently_tickets)
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @foreach ($recently_tickets as $ticket)

                            <div class="timeline-block">
                                <span class="timeline-step badge-success">
                                    <i class="fa fa-dollar-sign"></i>
                                </span>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between pt-1">
                                        <div>
                                        <a href="/customers/{{ $ticket->customer->uuid}}"><span class="text-muted font-weight-bold"> {{ $ticket->customer->name }}</span></a>
                                        </div>
                                        <div class="text-right">
                                            <small class="text-muted"><i class="fas fa-clock mr-1"></i>{{ $ticket->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <h6 class="text-sm mt-1 mb-0 pl-1">進帳金額:  {{ number_format($ticket->price) }}</h6>
                                </div>
                            </div>

                            @endforeach
                        </div>
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

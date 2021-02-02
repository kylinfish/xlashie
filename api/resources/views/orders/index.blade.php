@extends('layouts.app')
@section('content')
<div class="offset-lg-1 col-lg-10">

@include('common.alert')

<div class="row align-items-center mb-3">
    <h1>歷史訂單</h1>
</div>

<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
    </div>
    @if (count($orders) == 0)
        <div class="badge badge-warning"><h3>從建立您的第一筆訂單開始吧</h3></div>
    @else
    <div class="table-responsive">

        <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">客戶名稱</th>
                    <th class="text-center">訂單金額</th>
                    <th class="text-center">付款方式</th>
                    <th class="text-center">品項數量</th>
                    <th class="text-center">訂單時間</th>
                </tr>
            </thead>
            <tbody class="list">

                @foreach ($orders as $order)
                <tr>
                    <td class="text-center"><a href="/customers/{{ $order->customer->uuid }}">{{ $order->customer->name }}</a></td>
                    <td class="text-center">{{ number_format($order->price) }}</td>
                    <td class="text-center">{{ $order->payment }}</td>
                    <td class="text-center">{{ $order->order_items->count() }}</td>
                    <td class="text-center">{{ $order->created_at }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

    <div class="card-footer py-4 table-action">
        <div class="row float-right">
            {{ $orders->withPath(request()->url())->links() }}
        </div>
    </div>
    @endif
</div>

</div>
@endsection
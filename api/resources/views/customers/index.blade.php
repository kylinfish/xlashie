@extends('layouts.app')
@section('content')
<div class="offset-lg-1 col-lg-10">

    <div class="row align-items-center mb-3">
    <div class="col-12">
        <a href="/customers/create" class="btn btn-primary float-right ml-2">新增客戶</a>
        <a href="{{ route('customers/import') }}" class="btn btn-outline-primary float-right">匯入</a>
        <h1>客戶清單</h1>
    </div>
</div>

@include('common.search')

@include('common.alert')

<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <h3 class="mb-0">客戶列表總覽 - 進入客戶頁面開始管理交易紀錄吧</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-sm align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th>名字</th>
                    <th>電話</th>
                    <th>最後交易日期</th>
                    <th>建立時間</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody class="list">

                @foreach ($customers as $customer)
                <tr>
                    <td><a href="/customers/{{ $customer->uuid }}">{{ $customer->name }}</a></td>

                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td class="text-right form-inline">
                        <a href="/customers/{{ $customer->uuid }}" class="btn btn-outline-default">管理/交易</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="card-footer py-4 table-action">
        <div class="row float-right">
            {{ $customers->withPath(request()->url())->links() }}
        </div>
    </div>
</div>
</div>


@include('modal.customers.create')
@include('modal.customers.inventory_mark')
@endsection
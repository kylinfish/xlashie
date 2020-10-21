@extends('layouts.app')
@section('content')
<div class="offset-lg-1 col-lg-10">
    @if (request()->get('wizard') or $is_wizard ?? '')
    <div class="mb-4 btn-group btn-group-sm d-flex border" role="group" aria-label="...">
        <a href="/company/?wizard=1" type="button" class="btn btn-success w-100" disabled><span class="badge badge-lg badge-success mr-1">1</span> 建立店家</button>
        <a href="/menus/?wizard=1" type="button" class="btn btn-success w-100"><span class="badge badge-lg badge-success mr-1">2</span> 新增營業項目</a>
        <button type="button" class="btn btn-default w-100"><span class="badge badge-lg badge-primary mr-1">3</span> 新增客戶名單</button>
    </div>
    @endif


<div class="row align-items-center mb-3">
    <div class="col-lg-6 col-7">
        <h1>客戶清單</h1>
    </div>
    <div class="col-lg-6 col-5 text-right">
        <a href="/customers/create" class="btn btn-primary">新增客戶</a>
    </div>
</div>

@include('common.alert')

<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <h3 class="mb-0">客戶列表總覽</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-sm align-items-center table-flush table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-enter">名字</th>
                    <th class="text-enter">電話</th>
                    <th class="text-enter">最後交易日期</th>
                    <th class="text-enter">建立時間</th>
                    <th class="text-enter">操作</th>
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
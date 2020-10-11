@extends('layouts.app')
@section('content')
<div class="row align-items-center mb-3">
    <div class="col-lg-6 col-7">
        <h1>客戶總覽</h1>
    </div>
    <div class="col-lg-6 col-5 text-right">
        <a href="/customers/create" class="btn btn-primary">新增客戶</a>
    </div>
</div>

@include('common.alert')

<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <h3 class="mb-0">客戶列表</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-sm align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th class="text-enter">名字</th>
                    <th class="text-enter">電話 1</th>
                    <th class="text-enter">電話 2</th>
                    <th class="text-enter">Email</th>
                    <th class="text-enter">建立時間</th>
                    <th class="text-enter"></th>
                </tr>
            </thead>
            <tbody class="list">

                @foreach ($customers as $customer)
                <tr>
                    <td><a href="/customers/{{ $customer->uuid }}">{{ $customer->name }}</a></td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->cellphone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#" data-toggle="sweet-alert"
                                    data-sweet-alert="confirm">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
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


@include('modal.customers.create')
@include('modal.customers.inventory_mark')
@endsection
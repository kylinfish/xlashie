@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css">

<div class="offset-lg-1 col-lg-10">

   @if (request()->get('wizard') or $is_wizard ?? '')
   <div class="mb-4 btn-group btn-group-sm d-flex" role="group" aria-label="...">
       <a href="/company/?wizard=1" type="button" class="btn btn-success w-100"><span class="badge badge-lg badge-success mr-1">1</span> 建立店家</a>
       <button type="button" class="btn btn-default w-100"><span class="badge badge-lg badge-primary mr-1">2</span> 新增營業項目</button>
       <a href="/customers/?wizard=1" class="btn btn-secondary w-100"><span class="badge badge-lg badge-secondary mr-1">3</span> 新增客戶名單</a>
   </div>
   @endif

    <div class="row align-items-center mb-3">
        <div class="col-lg-6 col-7">
            <h1>營業項目</h1>
        </div>
        <div class="col-lg-6 col-5 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-menu-modal">新增</a>

        </div>
    </div>

   @include('common.alert')

    <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">您的產品列表 - 上架您的營業品項</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-sm table-flush">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">名稱</th>
                        <th class="text-center"><i class="fa fa-dollar-sign" aria-hidden="true"></i> 售價</th>
                        <th class="text-center">預設狀態</th>
                        <th class="text-center">建立時間</th>
                        <th class="text-center">操作</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($menus as $menu)
                    <tr>
                        <td class="text-center">
                            <p class="font-weight-600 name mb-0">
                                <a href="/menus/{{ $menu->id }}">{{ $menu->name }}</a>
                            </p>
                        </td>
                        <td class="text-center">{{ number_format($menu->price) }}</td>
                        <td class="text-center">{{ \App\Models\CustomerInventory::getStatusWording($menu->init_status) }}</td>
                        <td class="text-center">{{ $menu->created_at}}</td>
                        <td class="text-right form-inline">
                            <a href="/menus/{{ $menu->id }}" class="btn btn-outline-default">編輯</a>
                            <form action="/menus/{{ $menu->id }}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-outline-danger" href="#">刪除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modal.menus.create')

@endsection

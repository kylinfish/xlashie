@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css">

<div class="offset-lg-1 col-lg-10">
    <div class="row align-items-center mb-3">
        <div class="col-lg-6 col-7">
            <h1>營業項目管理</h1>
        </div>
        <div class="col-lg-6 col-5 text-right">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create-menu-modal">新增菜單</a>

        </div>
    </div>
    @if (\Session::has('alert'))
    <div class="alert alert-{{ \Session::get('alert') }} alert-dismissible fade show" role="alert">
        <span class="alert-text">{{ \Session::get('message') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
            <h3 class="mb-0">您的菜單列表 - 營業品項</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th class="text-enter">名稱</th>
                        <th class="text-enter"><i class="fa fa-dollar-sign" aria-hidden="true"></i> 售價</th>
                        <th class="text-enter">說明</th>
                        <th class="text-enter">預設狀態</th>
                        <th class="text-enter">建立時間</th>
                        <th class="text-enter"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($menus as $menu)
                    <tr>
                        <td>
                            <p class="font-weight-600 name mb-0">
                                <a href="/menus/{{ $menu->id }}">{{ $menu->name }}</a>
                            </p>
                        </td>
                        <td>{{ $menu->price }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($menu->description, 80, '...') }}</td>
                        <td>{{ \App\Models\CustomerInventory::getStatusWording($menu->init_status) }}</td>
                        <td>{{ $menu->created_at}}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <form action="/menus/{{ $menu->id }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="dropdown-item" href="#"><span
                                                class="text-danger">刪除</span></button>
                                    </form>
                                </div>
                            </div>
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

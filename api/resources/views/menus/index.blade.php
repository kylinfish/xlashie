@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="../../assets/vendor/sweetalert2/dist/sweetalert2.min.css">

<div class="row align-items-center mb-3">
    <div class="col-lg-6 col-7">
        <h1>營業項目管理</h1>
    </div>
    <div class="col-lg-6 col-5 text-right">
        <a href="#" class="btn btn-primary">新增菜單</a>
    </div>
</div>

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
                    <th class="text-enter">售價</th>
                    <th class="text-enter">定價</th>
                    <th class="text-enter">建立時間</th>
                    <th class="text-enter"></th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($menus as $menu)
                <tr>
                    <td>
                        <p class="font-weight-600 name mb-0">{{ $menu->name }}</p>
                        @if ($menu->sub_menus)
                        <div class="ml-5 mt-3 timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @foreach ($menu->sub_menus as $sub_menu)
                            <div class="timeline-block">
                                <span class="timeline-step badge-info">
                                    <i class="ni ni-bold-right"></i>
                                </span>
                                <div class="timeline-content">
                                    <small class="text-muted font-weight-bold"></small>
                                    <h5 class="mb-0">{{ $sub_menu->product->name }}</h5>
                                    <p class="text-sm mt-1 mb-0">{{ $sub_menu->product->description }}</p>
                                    <span class="badge ml-3 badge-secondary badge-pill">x</span>
                                    <span class="badge ml-3 badge-primary badge-pill">{{ $sub_menu->amount }}</span>
                                    <span class="badge mt-3 float-right badge-info badge-pill">庫存: {{ $sub_menu->product->quantity }}</span>

                                </div>
                            </div>
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $menu->sale_price}}</td>
                    <td>{{ $menu->purchase_price}}</td>
                    <td>{{ $menu->created_at}}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#" data-toggle="sweet-alert" data-sweet-alert="confirm">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
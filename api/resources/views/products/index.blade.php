@extends('layouts.app')
@section('content')
<div class="row align-items-center mb-3">
    <div class="col-lg-6 col-7">
        <h1>管理您的產品</h1>
    </div>
    <div class="col-lg-6 col-5 text-right">
        <a href="#" class="btn btn-primary">新增產品</a>
    </div>
</div>
<div class="alert alert-default" role="alert">
    <strong>補充說明: </strong><br>
    - 產品為建立菜單目錄的基本單位。不需管理庫存項目可將其設定成 0。<br>
    - 刪除會影響已經綁定的菜單項目喔！
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">產品名稱</th>
                    <th class="text-center">成本</th>
                    <th class="text-center">售價</th>
                    <th class="text-center">庫存數量</th>
                    <th class="text-center">產品分類</th>
                    <th class="text-center">啟用</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($products as $product)
                <tr>
                    <td>
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="{{ $product->avatar }}">
                            </a>
                            <div class="media-body">
                                <p class="h4">{{ $product->name }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="text-center">{{ $product->sale_price }}</td>
                    <td class="text-center">{{ $product->purchase_price }}</td>
                    <td class="text-center">{{ $product->quantity }}</td>
                    <td class="text-center">{{ $product->category_id }}</td>
                    <td>
                        <div class="cell">
                            <div class="d-flex justify-content-center">
                                <label class="custom-toggle">
                                    <input type="checkbox">
                                    <span data-label-off="No" data-label-on="Yes" class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">編輯</a>
                                <a class="dropdown-item" href="#">檢視</a>
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
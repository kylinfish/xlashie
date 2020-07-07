@extends('layouts.app')
@section('content')
<h1>管理您的產品</h1>
<div class="alert alert-default" role="alert">
    <strong>補充說明: </strong>
    產品為建立菜單目錄的基本單位。不需管理庫存項目可將其設定成 0。
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
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
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                            </a>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">護膚乳霜</span>
                            </div>
                        </div>
                    </th>
                    <td class="text-center">650</td>
                    <td class="text-center">300</td>
                    <td class="text-center">29</td>
                    <td class="text-center">3</td>
                    <td>
                        <div class="cell">
                            <div class="d-flex justify-content-center">
                                <label class="custom-toggle">
                                    <input type="checkbox">
                                    <span data-label-off="No" data-label-on="Yes"
                                        class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">編輯</a>
                                <a class="dropdown-item" href="#">檢視</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="../../assets/img/theme/react.jpg">
                            </a>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">依蘭柔嫩活膚霜</span>
                            </div>
                        </div>
                    </th>
                    <td class="text-center">2020</td>
                    <td class="text-center">789</td>
                    <td class="text-center">88</td>
                    <td class="text-center">3</td>
                    <td>
                        <div class="cell">
                            <div class="d-flex justify-content-center">
                                <label class="custom-toggle">
                                    <input type="checkbox">
                                    <span data-label-off="No" data-label-on="Yes"
                                        class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">編輯</a>
                                <a class="dropdown-item" href="#">檢視</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="../../assets/img/theme/sketch.jpg">
                            </a>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">薰衣草潤膚皂【液體狀】500ml</span>
                            </div>
                        </div>
                    </th>
                    <td class="text-center">1930</td>
                    <td class="text-center">150</td>
                    <td class="text-center">950</td>
                    <td class="text-center">3</td>
                    <td>
                        <div class="cell">
                            <div class="d-flex justify-content-center">
                                <label class="custom-toggle">
                                    <input type="checkbox" checked>
                                    <span data-label-off="No" data-label-on="Yes"
                                        class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">編輯</a>
                                <a class="dropdown-item" href="#">檢視</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="../../assets/img/theme/sketch.jpg">
                            </a>
                            <div class="media-body">
                                <span class="name mb-0 text-sm">護膚海藻面膜</span>
                            </div>
                        </div>
                    </th>
                    <td class="text-center">200</td>
                    <td class="text-center">150</td>
                    <td class="text-center">76</td>
                    <td class="text-center">3</td>
                    <td>
                        <div class="cell">
                            <div class="d-flex justify-content-center">
                                <label class="custom-toggle">
                                    <input type="checkbox" checked>
                                    <span data-label-off="No" data-label-on="Yes"
                                        class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">編輯</a>
                                <a class="dropdown-item" href="#">檢視</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

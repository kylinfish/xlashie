@extends('layouts.app')
@section('content')
<h1>營業項目管理</h1>
<div class="card">
    <!-- Card header -->
    <div class="card-header border-0">
        <h3 class="mb-0">您的菜單列表 - 營業品項</h3>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th class="texㄔ-enter">名稱</th>
                    <th class="text-enter">售價</th>
                    <th class="text-enter">定價</th>
                    <th class="text-enter">建立時間</th>
                    <th class="text-enter"></th>
                </tr>
            </thead>
            <tbody class="list">
                <tr>
                    <td>
                        <p class="font-weight-600 name mb-0">追夢椅 <span class="badge float-right badge-info badge-pill">庫存: 7</span></p>
                    </td>
                    <td>71000</td>
                    <td>2580</td>
                    <td>2018/03/15 20:32:40</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">檢視</a>
                                <a class="dropdown-item" href="#">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-weight-600 name mb-0">誠實豆沙包 <span class="badge float-right badge-info badge-pill">庫存: 225</span></p>
                    </td>
                    <td>350</td>
                    <td>50</td>
                    <td>2020/04/30 20:32:40</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">檢視</a>
                                <a class="dropdown-item" href="#">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
                    </td>
                </tr>


                <tr>
                    <td>
                        <p class="font-weight-600 name mb-0">無效精華霜 <span class="badge float-right badge-info badge-pill">庫存: 68</span></p>
                    </td>
                    <td>1000</td>
                    <td>300</td>
                    <td>2020/03/15 20:32:40</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">檢視</a>
                                <a class="dropdown-item" href="#">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-weight-600 name mb-0">超強效組合包</p>
                        <div class="ml-5 mt-3 timeline timeline-one-side" data-timeline-content="axis"
                            data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                                <span class="timeline-step badge-info">
                                    <i class="ni ni-bold-right"></i>
                                </span>
                                <div class="timeline-content">
                                    <small class="text-muted font-weight-bold"></small>
                                    <h5 class="mb-0">驚天動地百靈果</h5>
                                    <p class="text-sm mt-1 mb-0">百香果冰沙左鳳梨炒飯</p>
                                    <span class="badge ml-3 badge-secondary badge-pill">x</span>
                                    <span class="badge ml-3 badge-primary badge-pill">2</span>
                                    <span class="badge mt-3 float-right badge-info badge-pill">庫存: 22</span>
                                    
                                </div>
                            </div>

                            <div class="timeline-block">
                                <span class="timeline-step badge-info">
                                    <i class="ni ni-bold-right"></i>
                                </span>

                                <div class="timeline-content">
                                    <h4 class="mb-0">補給飲料一瓶</h4>
                                    <img src="https://www.lardlabo.asia/wp-content/uploads/2019/11/lardlabo_skincarecream2.jpg"
                                        class="avatar">
                                    <span class="badge ml-3 badge-secondary badge-pill">x</span>
                                    <span class="badge ml-3 badge-primary badge-pill">2</span>
                                    <span class="badge mt-3 float-right badge-info badge-pill">庫存: 22</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>234</td>
                    <td>242</td>
                    <td>2020/03/20 15:55:00</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">檢視</a>
                                <a class="dropdown-item" href="#">刪除</a>
                                <a class="dropdown-item" href="#">編輯</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection

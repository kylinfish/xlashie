@extends('layouts.app')
@section('content')
<div class="row align-items-center mb-3">
    <div class="col-lg-6 col-7">
        <h1>新增產品</h1>
    </div>
</div>
<div class="alert alert-default" role="alert">
    <strong>補充說明: </strong><br>
    - 產品為建立菜單目錄的基本單位。不需管理庫存項目可將其設定成 0。<br>
    - 刪除會影響已經綁定的菜單項目喔！
</div>

<div class="row">
    <div class="container">
        <div class="card">
            <form>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品名稱</label>
                            <input type="text" class="form-control" name="product_name" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品售價</label>
                            <input type="number" min="0" class="form-control" name="product_price" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">產品敘述</label>
                            <textarea max-length="255" rows="3" class="form-control" placeholder="產品描述(最多 255 字)"></textarea>
                        </div>
                    </div>


                    <a class="" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        新增組合內容?
                    </a>

                    <div class="collapse show" id="collapseExample">
                        <div class="card-body md-5">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <th class="text-center">產品項目</th>
                                        <th class="text-center">預設狀態</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">數量</th>
                                        <th class="text-center">新增</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </td>
                                            <td width="20%">
                                                <select class="form-control">
                                                    <option>已完成</option>
                                                    <option>未使用</option>
                                                </select>
                                            </td>
                                            <td>
                                                <span class="badge mt-3 ml-3 badge-secondary badge-pill">x</span>
                                            </td>
                                            <td>
                                                <input type="number" min="0" class="form-control" name="amount" required>
                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-icon btn-outline-success btn-lg" type="button" @click="onAddItem" data-toggle="tooltip" title="選擇品項並新增">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="offset-lg-3 col-lg-6">
        <form action="/menus/{{ $menu->id }}/" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            {{ method_field('PUT') }}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">編輯產品</h5>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品名稱</label>
                            <input type="text" class="form-control" name="name" value="{{ $menu->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品售價</label>
                            <input type="number" min="0" class="form-control" name="price"
                                value="{{ $menu->price }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 購買後預設狀態</label>
                            <select class="form-control" name="init_status">
                                <option value="0"
                                @if ($menu->init_status == 0)
                                selected="selected"
                                @endif
                                ><span>未使用</span></option>
                                <option value="1"
                                @if ($menu->init_status == 1)
                                selected="selected"
                                @endif
                                ><span>已發放</span></option>
                                <option value="2"
                                @if ($menu->init_status == 2)
                                selected="selected"
                                @endif
                                ><span>已使用</span></option>
                                <option value="3"
                                @if ($menu->init_status == 3)
                                selected="selected"
                                @endif
                                ><span>積欠未發</span></option>
                                <option value="4"
                                @if ($menu->init_status == 4)
                                selected="selected"
                                @endif
                                ><span>註銷失效</span></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">產品敘述</label>
                            <textarea maxlength="255" rows="3" class="form-control" placeholder="產品描述(最多 255 字)"
                                name="description" value="{{ $menu->description }}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/menus/" class="btn btn-secondary" data-dismiss="modal">取消</a>
                    <button type="submit" class="btn btn-warning">修改</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

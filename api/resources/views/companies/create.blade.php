@extends('layouts.app')
@section('content')
<div class="row">
    <div class="offset-lg-3 col-lg-6">

        @include('common.alert')

        @if (request()->get('wizard'))
        <div class="mb-4 btn-group btn-group-sm d-flex" role="group" aria-label="...">
            <button type="button" class="btn btn-default w-100 active"><span class="badge badge-lg badge-primary mr-1">1</span> 建立店家</button>
            <button type="button" class="btn btn-secondary w-100" disabled><span class="badge badge-lg badge-secondary mr-1">2</span> 新增營業項目</button>
            <button type="button" class="btn btn-secondary w-100" disabled><span class="badge badge-lg badge-secondary mr-1">3</span> 新增客戶名單</button>
        </div>
        @endif

        <form action="/company/" method="POST">
            @csrf
            <!-- {{ csrf_field() }} -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">從建立你的專屬公司/店家開始吧</h5>
                    <h5 class="float-right"> <span class="text-warning">*</a> 為必填</h5>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 公司名稱</label>
                            @error('name')
                            <span class="text-danger float-right">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="30"
                                name="name" placeholder="公司/店家名稱" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 英文公司帳號</label>
                            <label class="form-control-label" for="email" data-toggle="tooltip" data-placement="right"
                                title="帳號之後不能更動">
                                <span class="text-info"><i class="fa fa-info-circle"></i></span>
                            </label>
                            @error('account')
                            <span class="text-danger float-right">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control @error('account') is-invalid @enderror"
                                maxlength="30" name="account" placeholder="英文字母或數字，請勿使用特殊符號及空白 (最多 30 字)"
                                value="{{ old('account') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">聯絡方式</label>
                            @error('contact')
                            <span class="text-danger float-right">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                maxlength="50" maxlength="50" name="contact" placeholder="電話/Line/FB/Email (最多 50 字)"
                                value="{{ old('contact') }}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">服務說明</label>
                            @error('description')
                            <span class="text-danger float-right">{{ $message }}</span>
                            @enderror
                            <textarea class="form-control @error('description') is-invalid @enderror" maxlength="100"
                                rows="4" name="description"
                                placeholder="店家或服務描述 (最多 100 字)">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/" class="btn btn-secondary" data-dismiss="modal">取消</a>
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

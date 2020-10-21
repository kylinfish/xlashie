@extends('layouts.app')
@section('content')

<div class="row">
    <div class="offset-lg-2 col-lg-8">

        @include('common.alert')

        <form action="/customers/" method="POST">
            @csrf
            <!-- {{ csrf_field() }} -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新增顧客</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <h5 class="float-right"> <span class="text-warning">*</a> 名字為必填</h5>
                                <label class="form-control-label" for="name"><span class="text-danger">*</span> 名字</label>
                                @error('name')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email" data-toggle="tooltip" data-placement="right"
                                title="開放顧客查詢資料必須綁定 Email，您也可以之後再進行修改">
                                    <!--<span class="text-info"><i class="fa fa-info-circle"></i></span>--> Email
                                </label>
                                @error('email')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="phone">電話</label>
                                @error('phone')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="text" name="phone" maxlength="10" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" placeholder="數字 10 碼" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="cellphone">手機</label>
                                @error('cellphone')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="text" name="cellphone"  maxlength="10" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('cellphone') }}" placeholder="數字 10 碼">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="gender">性別</label>
                                @error('gender')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <select name="gender" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('gender') }}">>
                                    <option value="0">不指定</option>
                                    <option value="1">男生</option>
                                    <option value="2">女生</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="birth">生日</label>
                                @error('birth')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="date" name="birth" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('birth') }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="address">地址</label>
                                @error('address')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <input type="text" name="address" class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('address') }}">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">備註 1:</label>
                                @error('note_1')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control @error('description') is-invalid @enderror" name="note_1">{{ old('note_1') }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">備註 2:</label>
                                @error('note_2')
                                <span class="text-danger float-right">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control @error('description') is-invalid @enderror" name="note_2">{{ old('note_2') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row float-right">
                        <div class="col-md-12">
                            <span class="text-warning pr-2"></span>
                            <a href="/customers/" class="btn btn-icon btn-secondary">
                                <i class="fa fa-times pr-2"></i>取消
                            </a>
                            <button type="submit" class="btn btn-icon btn-success">
                                <i class="fa fa-save pr-2"></i>送出</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

</form>
@endsection
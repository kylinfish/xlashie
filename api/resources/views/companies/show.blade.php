@extends('layouts.app')
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="col-md">

        <img width="30%" class="float-right" src="/assets/images/undraw_business_shop.svg" alt="">
        <div class="card border-0 shadow my-5  col-md-8">
            <div class="card-body p-5">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">公司名稱</span>
                        </div>
                        @error('name')
                        <span class="text-danger float-right">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="30"
                            name="name" placeholder="公司/店家名稱" value="{{ $company->name }}" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">公司帳號</span>
                        </div>
                        @error('account')
                        <span class="text-danger float-right">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('account') is-invalid @enderror" maxlength="30"
                            name="account" placeholder="英文字母或數字，請勿使用特殊符號及空白 (最多 30 字)" value="{{ $company->account }}"
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">聯絡方式</span>
                        </div>
                        @error('contact')
                        <span class="text-danger float-right">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" maxlength="50"
                            maxlength="50" name="contact" placeholder="電話/Line/FB/Email (最多 50 字)"
                            value="{{ $company->contact }}">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">服務說明</span>
                        </div>
                        @error('description')
                        <span class="text-danger float-right">{{ $message }}</span>
                        @enderror
                        <textarea class="form-control @error('description') is-invalid @enderror" maxlength="100"
                            rows="5" name="description" placeholder="店家或服務描述 (最多 100 字)">{{ $company->description }}</textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<link rel="preload" href="{{ asset('/assets/vendor/quill/dist/quill.core.css') }}" type="text/css" as="style">
@include('common.alert')
<input type="hidden" name="menu" value="{{ $menus }}">
<input type="hidden" name="isGroup" value="{{ $is_group }}">
<input type="hidden" name="users" value="{{ $user_list }}">
<div class="row">
    <div class="col-lg-3">
        <a href="/customers/" class="btn btn-block btn-outline-default mt--2 mb-2">回到客戶清單</a>
        <div class="card card-profile mb-1">
            <img src="../../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top d-none d-sm-block">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2  d-none d-sm-block">
                    <div class="card-profile-image">
                        <a href="#!">
                            <img src="/assets/img/theme/team-3.jpg" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-md-7">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <h1>{{ $customer->name }}</h1>
                        </div>
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                <span class="heading">{{ $order_count }}</span>
                                <span class="description">訂單數目</span>
                            </div>
                            <div>
                                <span class="heading">{{ $inventory_count }}</span>
                                <span class="description">已購產品</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="text-center">

                    <div class="mt-2">
                        <p class="h5">建立時間: {{ $customer->created_at->format('Y/m/d') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-9">
        @include('customers.tab')
    </div>
</div>

@include('modal.customers.inventory_mark')

@endsection

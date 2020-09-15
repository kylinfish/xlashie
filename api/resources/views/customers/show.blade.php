@extends('layouts.nosidebar')
@section('content')
<link rel="stylesheet" href="{{ asset('/assets/vendor/quill/dist/quill.core.css') }}" type="text/css">

<div class="row">
    <div class="col-md-3">
        <a href="/customers/" class="btn btn-block btn-outline-default mt--2 mb-2">回到客戶清單</a>
        <div class="card card-profile mb-1">
            <img src="../../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                            <img src="../../assets/img/theme/team-3.jpg" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-7">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <h1>{{ $customer->name }}</h1>
                        </div>
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                <span class="heading">22</span>
                                <span class="description">消費次數</span>
                            </div>
                            <div>
                                <span class="heading">10</span>
                                <span class="description">庫存清單</span>
                            </div>
                            <div>
                                <span class="heading">89</span>
                                <span class="description">預收金</span>
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
    <div class="col-md-9">
        @include('customers.tab')
    </div>
</div>

@include('modal.customers.inventory_mark')
<script src="{{ asset('/assets/vendor/quill/dist/quill.min.js') }}"></script>

@endsection

@extends('layouts.app')
@section('content')
<style>
    body {
        background: url('/assets/img/company.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }

</style>

<!-- Page Content -->
<div class="container">
    <div class="col-md">
        <img width="30%" class="float-right" src="/assets/images/undraw_business_shop.svg" alt="">
        <div class="card border-0 shadow my-5  col-md-8">
            <div class="card-body p-5">
                <h1 class="font-weight-light">{{ $company->name }} <small class="text-gray"></h1>
                <p class="lead">{{ $company->description }}</p>
                <br>
                <ul>
                    <li>帳號: {{ $company->account }}</li>
                    <li>聯絡方式: {{ $company->contact }}</li>
                </ul>
                <div style="height: 50px"></div>
            </div>
        </div>

    </div>
</div>
@endsection

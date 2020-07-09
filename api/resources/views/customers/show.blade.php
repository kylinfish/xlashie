@extends('layouts.app')
@section('content')
<h1>
    <a data-toggle="collapse" href="#profileDetailCollapse" role="button" aria-expanded="false" aria-controls="profileDetailCollapse">
        <i class="ni ni-single-02"></i> <ins>{{ $customer->name }}</ins>
    </a>
</h1>

<div class="collapse" id="profileDetailCollapse">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-9 row">
                <div class="col-md-4 text-right">電話</div>
                <div class="col-md-8">{{ $customer->phone }}</div>
            </div>
            <div class="col-md-9 row">
                <div class="col-md-4 text-right">電話</div>
                <div class="col-md-8">{{ $customer->phone }}</div>
            </div>
            <div class="col-md-9 row">
                <div class="col-md-4 text-right">電話</div>
                <div class="col-md-8">{{ $customer->phone }}</div>
            </div>
            <div class="col-md-9 row">
                <div class="col-md-4 text-right">電話</div>
                <div class="col-md-8">{{ $customer->phone }}</div>
            </div>
            <div class="col-md-9 row">
                <div class="col-md-2 text-right">地址</div>
                <div class="col-md-8">{{ $customer->address }}</div>
            </div>
            <div class="col-md-3 card-profile-image">
                <a href="#!">
                    <img src="../../assets/img/theme/team-4.jpg">
                </a>
            </div>

        </div>

    </div>
</div>


@include('customers.tab')
@endsection
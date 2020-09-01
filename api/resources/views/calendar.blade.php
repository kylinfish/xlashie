@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">

<div class="col-md-10 offset-md-1 container">
<div class="card card-calendar">
    <div class="card-header">
        <h5 class="h3 mb-0">工作行事曆</h5>
    </div>
    <!-- Card body -->
    <div class="card-body p-0">
        <div class="calendar" data-toggle="calendar" id="calendar"></div>
    </div>
</div>
</div>


@endsection

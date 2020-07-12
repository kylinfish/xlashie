@extends('layouts.app')
@section('content')
<h1><i class="ni ni-single-02"></i> <ins>{{ $customer->name }}</ins></h1>
@include('customers.tab')
@include('modal.customers.inventory_mark')

@endsection

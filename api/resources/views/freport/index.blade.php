@extends('layouts.app')
@section('content')
<div class="offset-lg-1 col-lg-10">
    @include('common.alert')
    <div class="row align-items-center mb-3">
        <h1>營收報表 - 當月</h1>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">日期</th>
                        <th class="text-center">營收總額</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($freports as $date => $sums)
                    <tr>
                        <td class="text-center">{{ $date }}</td>
                        <td class="text-center">{{ number_format($sums) }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td class="text-center"><b>總計</b></td>
                        <td class="text-center"><b>{{ number_format($total_income) }}</b></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
@include('common.alert')

<section class="section section-lg pt-lg-0">
    <div class="container">
        <div class="offset-lg-1 col-lg-10">
            <div class="row align-items-center mb-3">
                <div class="col-12">
                    <h1>操作記錄</h1>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @if ($oplogs->count() == 0)

                    <div class="card bg-gradient-warning text-white border-0 p-3">
                        目前沒有操作記錄，趕快開始第一筆紀錄吧
                    </div>

                    @else

                    <div class="card p-3 rounded shadow-sm mb-4">
                        <div class="timeline timeline-one-side" data-timeline-content="axis"
                            data-timeline-axis-style="dashed">
                            @foreach ($oplogs as $log)

                            <div class="timeline-block">
                                <span class="timeline-step badge-success">
                                    <i class="fa fa-dollar-sign"></i>
                                </span>
                                <div class="timeline-content">
                                    <div class="pt-1">
                                        <div>
                                            <code>{{ $log->user->name }}</code>
                                            <b
                                                class="text-primary">{{ \App\Models\OpLog::CONTROL_MAP_FOR_HUMAN[$log->controller] }}</b>
                                            中執行了
                                            <span
                                                class="text-purple pr-2">{{ \App\Models\OpLog::ACTION_MAP_FOR_HUMAN[$log->action] }}</span>。其中物件編號細節為:
                                            {{ $log->sth }}
                                        </div>
                                        <div class="text-right">
                                            <small class="text-muted"><i
                                                    class="fas fa-clock mr-1"></i>{{ $log->created_at }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="card-footer py-4 table-action">
                                <div class="row float-right">
                                    {{ $oplogs->withPath(request()->url())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

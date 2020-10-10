@if (\Session::has('alert'))
<div class="alert alert-{{ \Session::get('alert') }} alert-dismissible fade show" role="alert">
    <span class="alert-text">{{ \Session::get('message') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<ul role="tablist" class="mt--3 nav nav-pills nav-pills-primary nav-fill flex-column flex-sm-row nav-wrapper">
    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#purchase" class="nav-link active">
            <div>
                <span><i class="ni ni-cart pr-2"></i>購買交易</span>
            </div>
        </a>
    </li>

    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#inventory" class="nav-link">
            <div>
                <span><i class="fa fa-shopping-bag pr-2"></i>已購項目</span>
            </div>
        </a>
    </li>

    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#transaction" class="nav-link ">
            <div>
                <span><i class="fa fa-hand-holding-usd pr-2"></i>訂單交易紀錄</span>
            </div>
        </a>
    </li>

    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#profile" class="nav-link">
            <div>
                <span><i class="fa fa-user pr-2"></i>個人資料</span>
            </div>
        </a>
    </li>
</ul>

<div id="app" class="tab-content tab-space card shadow">
    <div id="profile" class="tab-pane">
        <profile-page></profile-page>
    </div>
    <div id="inventory" class="tab-pane">
        <inventory-page></inventory-page>
    </div>
    <div id="transaction" class="tab-pane">
        <transaction-page></transaction-page>
    </div>
    <div id="purchase" class="tab-pane active">
        <purchase-page></purchase-page>
    </div>
</div>

@push('footer-scripts')
<script defer src="{{ asset('/assets/vendor/quill/dist/quill.min.js') }}"></script>
<script defer src="{{ mix('js/customers/app.js') }}"></script>
@endpush

<ul role="tablist" class="mt--3 nav nav-pills nav-pills-primary nav-fill flex-column flex-sm-row nav-wrapper">
    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#profile" class="nav-link active">
            <div>
                <span><i class="fa fa-user pr-2"></i>個人資料</span>
            </div>
        </a>
    </li>
    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#inventory" class="nav-link">
            <div>
                <span><i class="fa fa-shopping-bag pr-2"></i>庫存清單</span>
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
        <a data-toggle="tab" role="tablist" href="#purchase" class="nav-link">
            <div>
                <span><i class="ni ni-cart pr-2"></i>購買</span>
            </div>
        </a>
    </li>
    <li data-toggle="tab" role="tablist" class="nav-item active">
        <a data-toggle="tab" role="tablist" href="#note" class="nav-link">
            <div>
                <span><i class="ni ni-single-copy-04 pr-2"></i>消費筆記</span>
            </div>
        </a>
    </li>
</ul>

<div id="app" class="tab-content tab-space card shadow">
    <div id="profile" class="tab-pane active">
        <profile-page></profile-page>
    </div>
    <div id="inventory" class="tab-pane">
        <inventory-page></inventory-page>
    </div>
    <div id="transaction" class="tab-pane">
        <transaction-page></transaction-page>
    </div>
    <div id="note" class="tab-pane">
        @include('customers.note')
    </div>
    <div id="purchase" class="tab-pane">
        <purchase-page></purchase-page>
    </div>
</div>


<script src="{{ mix('js/app.js') }}"></script>
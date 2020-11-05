<form class="mb-3 bt-3" action="/customers/search" method="GET">
    <div class="input-group input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text bg-default text-white">
                <i class="fas fa-user"></i> 客戶查詢</span>
            </span>
        </div>
        <input class="form-control" name="q" placeholder="請輸入 (姓名/電話/Email) 關鍵字" type="search" required>
        <div class="input-group-append">
            <button class="btn btn-outline-default" type="submit">查詢</button>
        </div>
    </div>
</form>
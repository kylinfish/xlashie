<div class="modal fade" id="create-menu-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <form action="/menus/" method="POST">
        @csrf
        <!-- {{ csrf_field() }} -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增銷售項目</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <h5 class="float-right"> <span class="text-warning">*</a> 為必填</h5>
                        <div class="form-group-sm">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品名稱</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group-sm">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品售價</label>
                            <input type="number" min="0" class="form-control" name="price" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group-sm">
                            <label class="form-control-label">預設狀態</label>

                            <select class="form-control" name="init_status">
                                <option value="-1"><span></span></option>
                                <option value="0"><span>未使用</span></option>
                                <option value="1"><span>已發放</span></option>
                                <option value="2"><span>已使用</span></option>
                            </select>
                            <p class="pt-2 text-gray"><i class="fa fa-info-circle text-info"></i>如果您的商品需提供顧客消費後核銷，可以選擇不同的預設狀態，客戶購買後可以在使用時針對產品做狀態改變。</p>
                            <ul class="list-group pl-3">
                                <li><span class="badge pr-1">空</span> <small>不使用狀態標記</small></li>
                                <li><span class="badge badge-secondary pr-1">未使用</span> <small>服務售後需要提供客戶核銷，可以選擇初始狀態為<b>未使用</b></small></li>
                                <li><span class="badge badge-primary pr-1">已發放</span>  <small>通常為實體產品，可以選擇初始狀態為<b>已發放</b> </small></li>
                                <li><span class="badge badge-primary pr-1">已使用</span>  <small>服務售後當下核銷，可選擇<b>已使用</b></small></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </div>
        </div>
    </form>
</div>

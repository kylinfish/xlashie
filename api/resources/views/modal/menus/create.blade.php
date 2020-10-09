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
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品名稱</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 產品售價</label>
                            <input type="number" min="0" class="form-control" name="price" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label"><span class="text-danger">*</span> 購買後預設狀態</label>
                            <select class="form-control" name="init_status">
                                <option value="0"><span>未使用</span></option>
                                <option value="1"><span>已發放</span></option>
                                <option value="2"><span>已使用</span></option>
                                <option value="3"><span>積欠未發</span></option>
                                <option value="4"><span>註銷失效</span></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">產品敘述</label>
                            <textarea maxlength="255" rows="3" class="form-control" placeholder="產品描述(最多 255 字)"
                                name="description"></textarea>
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

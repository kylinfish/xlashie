<div class="modal fade" id="inventory-status-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center mt-2 mb-3">
                            <h3 class="text-blue">商品資訊</h3>
                        </div>
                        <div class="form-group">
                            <dl class="row">
                                <dt class="col-sm-5 text-right">品項</dt>
                                <dd class="col-sm-5 text-center">面膜(10)</dd>
                            </dl>
                        </div>
                        <div class="form-group">
                            <dl class="row">
                                <dt class="col-sm-5 text-right">購買日期</dt>
                                <dd class="col-sm-5 text-center">2020/03/20</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center text-muted mb-3">
                            <h3 class="text-blue">核銷</h3>
                        </div>
                        <form role="form" class="form-inline">
                            <div class="form-group col-md-12">
                                <p class="col-md-4 mt-2">核銷日期</p>
                                <input class="col-md-8 float-right form-control" type="text" value="2020/03/20">
                            </div>
                            <div class="form-group col-md-12">
                                <p class="col-md-4 mt-2">核銷狀態</p>
                                <select class="form-control col-md-8">
                                    <option><span>已使用</span></option>
                                    <option><span>註銷失效</span></option>
                                    <option><span>未使用</span></option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <p class="col-md-4 mt-2">備註說明</p>
                                <textarea class="col-md-8 form-control" rows="2"></textarea>
                            </div>
                            <div class="offset-md-5 mt-3">
                                <button type="submit" class="btn btn-primary my-4">送出</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body description">
    <form action="" method="POST" role="form">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlInput1">訂單流水號</label>
                        <input type="text" class="form-control" value="INV-00003" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlInput1">訂單日期</label>
                        <input type="text" class="form-control" value="2020-07-04" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlInput1">付費方式</label>
                        <select class="form-control">
                            <option>現金</option>
                            <option>轉帳/匯款</option>
                            <option>預扣</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center border-right-0 border-bottom-0" scope="col"></th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">品項</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">數量</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">單價</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">總計</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center border-right-0 border-bottom-0">
                                    <button type="button" data-toggle="tooltip" title="刪除"
                                        class="btn btn-icon btn-outline-danger btn-lg"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                                <td>
                                    <input class="form-control" type="text" placeholder="Default input" value="面膜(十包)">
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number" value="2">
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number" value="1300">
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number" value="2600">
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center border-right-0 border-bottom-0">
                                    <button type="button" data-toggle="tooltip" title="新增"
                                        class="btn btn-icon btn-outline-success btn-lg"><i class="fa fa-plus"></i>
                                    </button>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" id="">
                                            <option></option>
                                            <option>面膜</option>
                                            <option>護呼乳霜</option>
                                            <option>眼霜</option>
                                            <option>保養美白課程</option>
                                            <option>粉刺課程</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number">
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number">
                                </td>
                                <td>
                                    <input class="form-control text-center" type="number">
                                </td>

                            </tr>
                            <tr id="tr-subtotal">
                                <td colspan="4" class="text-right border-right-0 border-bottom-0"><strong>小計</strong>
                                </td>
                                <td class="text-center border-bottom-0 long-texts">
                                    2600
                                </td>
                            </tr>
                            <tr id="tr-discount">
                                <td colspan="4" class="text-right border-right-0 border-bottom-0">
                                    <a href="#"><strong>新增折扣</strong></a>
                                </td>
                                <td class="text-center">0</td>
                            </tr>
                            <tr id="tr-total">
                                <td colspan="4" class="text-right border-right-0 border-bottom-0">
                                    <strong>購買金額總計</strong>
                                </td>
                                <td class="text-center">2600</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">消費備註</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                </div>
                <div class="card-footer">
                    <div class="row float-right">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-icon btn-secondary">
                                <i class="fa fa-times pr-2"></i>取消
                            </a>
                            <button type="submit" class="btn btn-icon btn-success">
                                <i class="fa fa-save pr-2"></i>儲存</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

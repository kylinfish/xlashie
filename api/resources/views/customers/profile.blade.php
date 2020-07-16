<form>
    <div class="col-sm-12 mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="phone">電話</label>
                        <input type="text" id="phone" class="form-control" value="{{ $customer->phone }}" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="phone">手機</label>
                        <input type="text" id="cellphone" class="form-control" value="{{ $customer->cellphone }}"
                            disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="gender"">性別</label>
                                <input type=" text" id="gender" class="form-control" value="{{ $customer->gender }}"
                            disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="birth">生日</label>
                        <input type="text" id="birth" class="form-control" value="{{ $customer->birth }}" disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" value="{{ $customer->email }}" disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="email">地址</label>
                        <input type="text" id="address" class="form-control" value="{{ $customer->address }}" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 1:</label>
                        <textarea class="form-control" rows="3" disabled>{{ $customer->note_1 }}"</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 2:</label>
                        <textarea class="form-control" rows="3" disabled>{{ $customer->note_2 }}"</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <p class="h4 float-left pt-2 text-gray">上次修改時間: {{ $customer->updated_at->format('Y/m/d h:m:s') }}</p>
            <div class="row float-right">
                <div class="col-md-12">

                    <a href="#" class="btn btn-icon btn-secondary">
                        <i class="fa fa-times pr-2"></i>取消
                    </a>
                    <button type="submit" class="btn btn-icon btn-success">
                        <i class="fa fa-save pr-2"></i>修改</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

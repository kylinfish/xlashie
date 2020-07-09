<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-profile mb-1">
                <img src="../../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="https://i.pravatar.cc/150" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                        <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading">22</span>
                                    <span class="description">消費次數</span>
                                </div>
                                <div>
                                    <span class="heading">10</span>
                                    <span class="description">庫存清單</span>
                                </div>
                                <div>
                                    <span class="heading">89</span>
                                    <span class="description">預收金</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2>{{ $customer->name }}</h2>
                        <div class="mt-2">
                            <p class="h5">建立時間: {{ $customer->created_at->format('Y/m/d') }}</p>
                            <p class="h5">最後修改: {{ $customer->updated_at->format('Y/m/d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-body row">
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
                <div class="col-lg-12">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 1:</label>
                        <textarea class="form-control" rows="3" disabled>{{ $customer->note_1 }}"</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 2:</label>
                        <textarea class="form-control" rows="3" disabled>{{ $customer->note_2 }}"</textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

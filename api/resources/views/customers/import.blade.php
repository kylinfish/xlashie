@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
<div id="app" class="row">
    <div class="offset-lg-2 col-lg-8">

        @include('common.alert')

        <form action="{{ route('customers/import/upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">匯入顧客資料</h5>
                    <a href="{{ asset('import_sample.csv') }}" target="_blank">下載 CSV 範例檔</a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>欄位填寫說明：</label>
                            <ul>
                                <li>電子郵件(Email): 選填，但不可與已新增客戶重複，至多 50 字。</li>
                                <li>姓名(Name): 必填，至多 20 字。</li>
                                <li>家電(Phone): 選填，數字 10 碼，例如： 0212345789。</li>
                                <li>手機(Cellphone): 選填，數字 10 碼，例如： 0987654321。</li>
                                <li>生日(Birth): 選填，請符合日期格式 YYYY-MM-DD，例如： 1968-06-05。</li>
                                <li>性別(Gender): 選填，未指定 0, 男生 1, 女生 2。</li>
                                <li>地址(Address): 選填，至多 150 字。</li>
                                <li>備註1(Note1): 選填。</li>
                                <li>備註2(Note2): 選填。</li>
                            </ul>
                            <div>
                                請選擇匯入的 csv 檔案，檔案上限 10MB，單次匯入筆數限制為 1,000 筆。
                            </div>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" accept=".csv">
                                <label class="custom-file-label" for="file">Select file</label>
                            </div>
                            @error('file')
                            <span class="text-danger float-right">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="skip_head_line" class="custom-control-input" id="skipHeadLine" value="1">
                                <label class="custom-control-label" for="skipHeadLine">略過檔案首行</label>
                            </div>
                        </div>
                        @error('error_lines')
                        <div class="col-lg-12 mt-3">
                            <div class="form-group">
                                <label for="error_lines">未新增行數</label>
                                <textarea class="form-control is-invalid" id="error_lines" rows="3" readonly>{{ implode(',', array_keys($errors->get('error_lines'))) }}</textarea>
                            </div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row float-right">
                        <div class="col-md-12">
                            <span class="text-warning pr-2"></span>
                            <a href="/customers/" class="btn btn-icon btn-secondary">
                                <i class="fa fa-times pr-2"></i>取消
                            </a>
                            <button type="submit" class="btn btn-icon btn-success" disabled="true">
                                <i class="fa fa-save pr-2"></i>送出</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

</form>
@endsection

@push('footer-scripts')
<script>
    document.querySelector('input[name="file"]').addEventListener('change', (event) => {
        let file = event.target;
        let submit = document.querySelector('form button[type="submit"');
        submit.disabled = false;
        if (file.files.length == 0) {
            submit.disabled = true;
            return;
        }
        if (file.files[0].size > 10 * 1024 * 1024) { // 10 MB
            submit.disabled = true;
            Swal.fire(
                '錯誤',
                '上傳的檔案過大 (限制 10 MB)',
                'warning'
            );
        }
    });
</script>
@endpush

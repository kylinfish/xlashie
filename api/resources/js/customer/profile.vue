<template>
<form id="profileForm" method="PUT" action="/api/customers/${this.uuid}/" @submit.prevent="onSubmit">
    <div class="col-sm-12 mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="name">名字</label>
                        <input type="text" id="name" :class="['form-control', {'is-invalid': validation.hasError('customer.name')}]" v-model="customer.name" :disabled="!isSubmitShow">
                        <div class="invalid-feedback">{{ validation.firstError('customer.name') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="email">Email</label>
                        <input type="email" id="email" :class="['form-control', {'is-invalid': validation.hasError('customer.email')}]" v-model="customer.email" disabled required>
                        <div class="invalid-feedback">{{ validation.firstError('customer.email') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="phone">電話</label>
                        <input type="text" id="phone" :class="['form-control', {'is-invalid': validation.hasError('customer.phone')}]" v-model="customer.phone" :disabled="!isSubmitShow">
                        <div class="invalid-feedback">{{ validation.firstError('customer.phone') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="cellphone">手機</label>
                        <input type="text" id="cellphone" :class="['form-control', {'is-invalid': validation.hasError('customer.cellphone')}]" v-model="customer.cellphone" :disabled="!isSubmitShow">
                        <div class="invalid-feedback">{{ validation.firstError('customer.cellphone') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="gender">性別</label>
                        <select id="gender" :class="['form-control', {'is-invalid': validation.hasError('customer.gender')}]" v-model="customer.gender" :disabled="!isSubmitShow">>
                            <option value="0">不指定</option>
                            <option value="1">男生</option>
                            <option value="2">女生</option>
                        </select>
                        <div class="invalid-feedback">{{ validation.firstError('customer.gender') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="birth">生日</label>
                        <input type="date" id="birth" :class="['form-control', {'is-invalid': validation.hasError('customer.gender')}]" v-model="customer.birth" :disabled="!isSubmitShow">
                        <div class="invalid-feedback">{{ validation.firstError('customer.birth') }}</div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group-sm">
                        <label class="form-control-label" for="address">地址</label>
                        <input type="text" id="address" :class="['form-control', {'is-invalid': validation.hasError('customer.address')}]" v-model="customer.address" :disabled="!isSubmitShow">
                        <div class="invalid-feedback">{{ validation.firstError('customer.address') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 1:</label>
                        <textarea :class="['form-control', {'is-invalid': validation.hasError('customer.note_1')}]" rows="3" v-model="customer.note_1" :disabled="!isSubmitShow"></textarea>
                        <div class="invalid-feedback">{{ validation.firstError('customer.note_1') }}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group-sm">
                        <label class="form-control-label">備註 2:</label>
                        <textarea :class="['form-control', {'is-invalid': validation.hasError('customer.note_2')}]" rows="3" v-model="customer.note_2" :disabled="!isSubmitShow"></textarea>
                        <div class="invalid-feedback">{{ validation.firstError('customer.note_2') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <p class="h4 float-left pt-2 text-gray">上次修改時間: {{ customer.updated_at }}</p>
            <div class="row float-right">
                <div class="col-md-12">
                    <span class="text-warning pr-2">{{validatorMsg}}</span>
                    <a href="#" class="btn btn-icon btn-secondary" v-show="isSubmitShow"  @click="toggle('cancel')">
                        <i class="fa fa-times pr-2"></i>取消
                    </a>
                    <button type="button" class="btn btn-icon btn-warning" v-show="isEditShow" @click="toggle('edit')">
                        <i class="fa fa-pen pr-2"></i>修改檔案</span>
                    </button>
                    <button type="submit" class="btn btn-icon btn-success" v-show="isSubmitShow">
                        <i class="fa fa-save pr-2"></i>送出</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>
import Form from './../plugins/form';
import SimpleVueValidation from 'simple-vue-validator';
const InputValidator = SimpleVueValidation.Validator;
export default {
    data: function () {
        let url = new URL(window.location.href)
        let uuid = url.pathname.split('/')[2]

        return {
            form: {},
            isEditShow: true,
            isSubmitShow: false,
            loading: true,
            uuid: uuid,
            customer: {},
            validatorMsg: '',
        };
    },

    mounted() {
        this.form = new Form('profileForm')
        this.loadProfile()
    },

    validators: {
        'customer.cellphone'(value) {
            return InputValidator.value(value).maxLength(10, "長度不能超過 10")
        },
        'customer.phone'(value) {
            return InputValidator.value(value).maxLength(10, "長度不能超過 10")
        },
        'customer.name'(value) {
            return InputValidator.value(value).maxLength(20, "長度不能超過 20")
        },
        'customer.address'(value) {
            return InputValidator.value(value).maxLength(150, "長度不能超過 150")
        },

    },

    methods: {
        loadProfile: function () {
            axios
                .get(`/api/customers/${this.uuid}`)
                .then((res) => {
                    this.customer = res.data.data;
                })
                .catch((res) => {
                    console.log("something is wrong")
                });
        },
        toggle (item) {
            if (item == 'edit') {this.isEditShow = false; this.isSubmitShow = true;}
            if (item == 'cancel') {this.isEditShow = true; this.isSubmitShow = false;}
        },

        onSubmit() {
            let self = this
            this.$validate()
                .then(function (success) {
                    if (!success) {
                        self.validatorMsg = "表單驗證失敗，請檢查欄位規則是否合格"
                        return;
                    }
                    self.validatorMsg = '';

                    axios({
                        method: "PUT",
                        url: `/api/customers/${self.uuid}/`,
                        data: self.customer,
                        headers: {
                            //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        }
                    })
                    .then((res) => {
                        self.toggle('cancel')
                        self.$swal({
                            title: "修改成功",
                            icon: "success",
                            timer: 900,
                            showConfirmButton: false
                        })
                        location.reload();
                    })
                    .catch((e) => {
                        self.$swal({
                            title: "修改失敗",
                            icon: "error",
                            text: e,
                        })
                    });
                })
        }
    }
};
</script>

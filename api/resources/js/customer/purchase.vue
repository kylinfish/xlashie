<template>
<div class="card-body description">
    <form method="POST" accept-charset="UTF-8" id="invoice" v-on:submit.prevent="onSubmit">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">訂單流水號</label>
                        <input type="text" :class="['form-control form-control-sm', {'is-invalid': validation.hasError('ticket')}]" v-model="ticket" required>
                        <div class="invalid-feedback">{{ validation.firstError('ticket') }}</div>
                    </div>
                    <div class="col-md-4">
                        <label>付費方式</label>
                        <select class="form-control form-control-sm" v-model="payment">
                            <option value="現金">現金</option>
                            <option value="轉帳/匯款">轉帳/匯款</option>
                            <option value="預扣">預扣</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>訂單日期</label>
                        <div class="form-group">
                            <input class="form-control form-control-sm" id="datetime" type="datetime-local" step="1" v-model="transaction_at">
                        </div>
                    </div>
                    <div class="form-group col-md">
                        <table class="table table-bordered table-primary">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">品項</th>
                                    <th class="text-center" scope="col">數量</th>
                                    <th class="text-center" scope="col">單價</th>
                                    <th class="text-center" scope="col">總計</th>
                                    <th class="text-center" scope="col">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select @change="onSelectItem" :class="['form-control', {'is-invalid': validation.hasError('selectedMenuId')}]" v-model="selectedMenuId">
                                            <option disabled value="">請選擇品項</option>
                                            <option v-for="(menu) in menus" v-bind:value="menu.value" :value="menu.id" :key="menu.id">
                                                {{ menu.name }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">{{ validation.firstError('selectedMenuId') }}</div>
                                    </td>
                                    <td>
                                        <input type="number" :class="['form-control text-center', {'is-invalid': validation.hasError('selectedQuantity')}]" v-model="selectedQuantity">
                                        <div class="invalid-feedback">{{ validation.firstError('selectedQuantity') }}</div>
                                    </td>
                                    <td>
                                        <input type="number" :class="['form-control text-center']" v-model="selectedPrice">
                                    </td>
                                    <td>
                                        <input type="number" disabled :class="'form-control text-center'" :value="selectedItemTotal">
                                        <div class="invalid-feedback">{{ validation.firstError('selectedItemTotal') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-icon btn-outline-success btn-lg" type="button" @click="onAddItem" data-toggle="tooltip" title="選擇品項並新增">
                                            加入
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                <label class="form-control-label">購買清單: </label>
                    <table class="table table-bordered" v-show="form.items.length >0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">品項</th>
                                <th class="text-center" scope="col">數量</th>
                                <th class="text-center" scope="col">單價</th>
                                <th class="text-center" scope="col">總計</th>
                                <th class="text-center" scope="col">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in form.items" :index="index">
                                <td class="text-center">{{ row.itemName }}</td>
                                <td class="text-center">{{ row.quantity }}</td>
                                <td class="text-center">{{ row.price }}</td>
                                <td class="text-center">{{ row.itemTotal }}</td>
                                <td class="text-center">
                                    <button class="btn btn-icon btn-outline-danger btn-sm" type="button" @click="onDeleteItem(index)" data-toggle="tooltip" title="刪除項目">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr id="tr-subtotal">
                                <td colspan="3" class="text-right border-right-0 border-bottom-0">
                                    <strong>小計</strong>
                                </td>
                                <td class="text-center border-bottom-0 long-texts">{{ totalPrice }}</td>
                                <td></td>
                            </tr>
                            <tr id="tr-discount">
                                <td colspan="3" class="text-right border-right-0 border-bottom-0">
                                    <a href="#" disabled data-toggle="tooltip" title="尚未開放"><strong>新增折扣</strong></a>
                                </td>
                                <td class="text-center"></td>
                                <td></td>
                            </tr>
                            <tr id="tr-total">
                                <td colspan="3" class="text-right border-right-0 border-bottom-0">
                                    <strong>購買金額總計</strong>
                                </td>
                                <td class="text-center">{{ finalPrice }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group"  v-show="form.items.length >0">
                    <label class="form-control-label">消費備註</label>
                    <textarea class="form-control" rows="2" v-model="note"></textarea>
                </div>
                <div class="card-footer"  v-show="form.items.length >0">
                    <div class="row float-right">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-icon btn-secondary">
                                <i class="fa fa-times pr-2"></i>取消
                            </a>
                            <button type="submit" class="btn btn-icon btn-primary">
                                <i class="fa fa-save pr-2"></i>新增交易</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</template>

<script>
import Form from './../plugins/form';
import SimpleVueValidation from 'simple-vue-validator';
import VueSweetalert2 from 'vue-sweetalert2';

const InputValidator = SimpleVueValidation.Validator;
Vue.use(SimpleVueValidation);
Vue.use(VueSweetalert2);

export default {
    data: function () {
        let url = new URL(window.location.href),
            uuid = url.pathname.split('/')[2]

        return {
            email: '',
            ticket: 'INV-003',
            transaction_at: new Date().toDatetimeLocalInputValue(),
            payment: '現金',
            selectedMenuId: '',
            selectedMenuItem: {},
            selectedPrice: '',
            selectedQuantity: '',
            selectedInitStatus: 0,

            menus: [],
            uuid: uuid,
            inventories: {},
            form: {},
            inputErrs: {},
            totalPrice: 0,
            note: '',
        };
    },

    computed: {
        selectedItemTotal: vm => vm.selectedQuantity * vm.selectedPrice,

        finalPrice: vm => vm.totalPrice,
    },

    mounted() {
        this.loadMenus();
        this.form = new Form('invoice');
        this.form.items = [];
    },

    validators: {
        selectedMenuId: function (value) {
            return InputValidator.value(value).required('請選擇購買產品');
        },
        selectedQuantity(value) {
            return InputValidator.value(value)
                .integer().greaterThan(0).required('至少要 1 個');
        },
    },

    methods: {
        DateTime(offset) {
            let d = new Date();
            d.setUTCHours(offset);
            return d.toISOString().split('.')[0]
        },

        loadMenus: function () {
            axios
                .get(`/api/menus/`)
                .then((res) => {
                    this.menus = res.data.data;
                })
                .catch((res) => {
                    console.log("Menus load failed.")
                });
        },

        onSubmit() {
            if (this.form.items.length < 1) {
                this.$swal({
                    title: "本次交易沒有購買項目",
                    icon: "error",
                    text: "請加入購買品項",
                })
                return
            }
            let formData = {
                "ticket": this.ticket,
                "payment": this.payment,
                "transaction_at": this.transaction_at,
                "items": this.form.items,
                "price": this.totalPrice,
                "note": this.note,
            }

            axios({
                method: "POST",
                url: `/api/customers/${this.uuid}/transactions/`,
                data: formData,
                headers: {
                    //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                }
            })
            .then((res) => {
                this.$swal({
                    title: "新增成功",
                    text: "稍後重新整理",
                    icon: "success",
                    timer: 900,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                })
            })
            .catch((e) => {
                this.$swal({
                    title: "新增失敗",
                    icon: "error",
                    text: e,
                })
            });
        },

        onAddItem() {
            let self = this;

            this.$validate()
                .then(function (success) {
                    if (!success) {
                        console.log("Validator Failed");
                        return;
                    }

                    const buyItem = {
                        "itemId": self.selectedMenuId,
                        "itemName": self.selectedMenuItem.name,
                        "price": self.selectedPrice,
                        "quantity": self.selectedQuantity,
                        "itemTotal": self.selectedItemTotal,
                        "initStatus": self.selectedInitStatus,
                    }

                    self.form.items.push(buyItem);
                    self.updateTotalPrice();
                    self.inputErrs = {};
                    self.selectedMenuId = '';
                    self.selectedMenuItem = {};
                    self.selectedPrice = '';
                    self.selectedQuantity = '';
                    self.selectedItemTotal = '';

                    self.validation.reset();
                })
        },

        onDeleteItem(index) {
            this.form.items.splice(index, 1);
            this.updateTotalPrice();
        },

        onSelectItem(menuId, index) {
            let item = this.menus.find((element, index, array) => {
                return element.id == this.selectedMenuId;
            })

            this.selectedMenuItem = item;
            this.selectedPrice = item.price;
            this.selectedQuantity = 1;
            this.selectedItemTotal = item.price;
            this.selectedInitStatus = item.init_status;
        },

        updateTotalPrice() {
            this.totalPrice = 0;
            this.form.items.forEach(element => {
                this.totalPrice += element.itemTotal;
            });
        },
    }
};
</script>

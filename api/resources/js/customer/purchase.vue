<template>
<div>
    <form method="POST" accept-charset="UTF-8" id="invoice" v-on:submit.prevent="onSubmit">
        <div class="rounded table-primary pt-3">
            <h3 class="px-4">購買項目</h3>
            <div class="container">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="mt-md-2">營業項目
                                <i class="fa fa-hand-point-down text-warning" data-toggle="tooltip" data-placement="right" title="可至營業項目頁面設定您的商品清單"></i>
                            </label>
                            <select @change="onSelectItem" :class="['form-control', {'is-invalid': validation.hasError('selectedMenuId')}]" v-model="selectedMenuId">
                                <option disabled value="">請選擇品項</option>
                                <option v-for="(menu) in menus" v-bind:value="menu.value" :value="menu.id" :key="menu.id">
                                    {{ menu.name }}
                                </option>
                            </select>
                            <div class="invalid-feedback">{{ validation.firstError('selectedMenuId') }}</div>
                        </div>

                        <div class="col-md-2 form-group">
                            <label class="mt-md-2">數量</label>
                            <input type="number" :class="['form-control text-center', {'is-invalid': validation.hasError('selectedQuantity')}]" v-model="selectedQuantity" min="1">
                            <div class="invalid-feedback">至少要一個</div>
                        </div>

                        <div class="col-md-2 form-group">
                            <label class="mt-md-2">單價</label>
                            <input type="number" :class="['form-control text-center']" v-model="selectedPrice">
                        </div>

                        <div class="col-md-2 form-group">
                            <label class="mt-md-2">總計</label>
                            <input type="number" disabled :class="'form-control text-center'" :value="selectedItemTotal">
                            <div class="invalid-feedback">{{ validation.firstError('selectedItemTotal') }}</div>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-md-2">操作</label>
                            <button class="btn btn-success btn-block" type="button" @click="onAddItem">加入</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row card-body">
            <div class="col-md-12">
                <div v-show="form.items.length <= 0">
                    <a href="/menus" v-if="this.menus.length == 0"><b class="text-warning">請先新增您的營業項目，讓系統幫您自動帶入設定 [點擊前往] <i class="fa fa-arrow-right"></i></b></a>

                    <p v-else class="lead text-center">選擇您的<b class="text-warning">「營業項目」</b> 下拉選單並點擊 <button class="btn btn-success btn-sm" disabled>加入</button> 按鈕來新增購買訂單吧!</p>
                </div>
                <div v-show="form.items.length >0">

                    <div class="form-group">
                        <span class="h3 text-primary">訂單品項</span>

                        <table class="table table-bordered table-sm table-hover table-responsive-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">品項</th>
                                    <th class="text-center">數量</th>
                                    <th class="text-center">單價</th>
                                    <th class="text-center">總計</th>
                                    <th class="text-center">刪除</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in form.items" :index="index">
                                    <td class="text-center">{{ row.itemName }}</td>
                                    <td class="text-center">{{ row.quantity | formatNumber }}</td>
                                    <td class="text-center">{{ row.price | formatNumber}}</td>
                                    <td class="text-center">{{ row.itemTotal | formatNumber}}</td>
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
                                    <td class="text-center border-bottom-0 long-texts">{{ subtotal | formatNumber }}</td>
                                    <td></td>
                                </tr>
                                <tr id="tr-discount">
                                    <td colspan="3" class="text-right border-right-0 border-bottom-0">

                                        <div class="row float-right mt-2">
                                            <div class="container form-inline">
                                                <div class="col-md-10 col-sm-12" v-show="isDiscount">
                                                    <select class="form-control form-control-sm col-md-5 col-sm-12" @change="onUpdateDiscount" v-model="selectDiscountType">
                                                        <option value="price" selected>折扣金額 ($)</option>
                                                        <option value="percent">折扣百分比 (%)</option>
                                                    </select>
                                                    <input :class="['form-control form-control-sm text-center col-md-5 col-sm-12', {'is-invalid': hasDiscountNumError }]" type="number" v-model="discountNum" @change="onUpdateDiscount" min="0">
                                                    <div class="invalid-feedback">
                                                        <span v-show="selectDiscountType == 'percent'">百分比介於 0 ~ 100 之間</span>
                                                        <span v-show="selectDiscountType == 'price'">不可為 0 且需小於 {{ subtotal }}</span>
                                                    </div>
                                                </div>

                                                <button class="btn btn-outline-default btn-sm col-12" type="button" v-show="isDiscount === false" @click="isDiscount = !isDiscount; selectDiscountType='price'">
                                                    <strong>新增折扣</strong>
                                                </button>
                                                <button class="btn btn-outline-warning btn-sm col-md-2 col-sm-10" type="button" v-show="isDiscount === true" @click="resetDiscount">
                                                    <strong>取消折扣</strong>
                                                </button>
                                            </div>
                                            <div class="container">
                                                <b v-show="totalPrice == 0" class="text-danger text-right">提醒您，該單入帳金額為 $0 喔!</b>
                                            </div>
                                        </div>

                                    </td>
                                    <td :class="['text-center align-middle', {'bg-pink': discount != 0}]">
                                        <span class="text-black-50">{{ discount | formatNumber }}</span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right border-right-0 border-bottom-0">
                                        <strong>購買金額總計</strong>
                                    </td>
                                    <td class="text-center bg-yellow"><span class="text-black-50">{{ totalPrice | formatNumber }}</span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label class="h3 text-primary">訂單資訊</label>
                        <div class="row">
                            <!--<div class="col-md-4">
                            <label for="">流水號</label>
                            <input type="text" :class="['form-control', {'is-invalid': validation.hasError('ticket')}]" v-model="ticket" required>
                            <div class="invalid-feedback">{{ validation.firstError('ticket') }}</div>
                        </div> -->
                            <div class="col-md-6">
                                <label>付費方式</label>
                                <div class="form-group-sm">
                                    <select class="form-control" v-model="payment">
                                        <option value="現金">現金</option>
                                        <option value="轉帳/匯款">轉帳/匯款</option>
                                        <option value="預扣">預扣</option>
                                        <option value="電子支付">電子支付</option>
                                        <option value="信用卡">信用卡</option>
                                    </select>
                                </div>
                                <label>日期</label>
                                <div class="form-group-sm">
                                    <input class="form-control" id="datetime" type="datetime-local" step="1" v-model="transaction_at">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">備註</label>
                                <textarea class="form-control" rows="5" v-model="note"></textarea>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer table-primary" v-show="form.items.length >0">

            <div class="row float-right">
                <div class="col-md-12">
                    <!--<a href="#" class="btn btn-icon btn-secondary">
                        <i class="fa fa-times pr-2"></i>取消
                    </a>-->
                    <button type="submit" class="btn btn-icon btn-primary">
                        <i class="fa fa-save pr-2"></i>新增交易</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</template>

<script>
import Form from "./../plugins/form";
import SimpleVueValidation from "simple-vue-validator";
import VueSweetalert2 from "vue-sweetalert2";

const ItemValidator = SimpleVueValidation.Validator;
const DiscountValidator = SimpleVueValidation.Validator;
Vue.use(SimpleVueValidation);
Vue.use(VueSweetalert2);

Vue.filter("formatNumber", (v) => {
    return new Intl.NumberFormat().format(v);
});

export default {
    data: function () {
        let url = new URL(window.location.href),
            uuid = url.pathname.split("/")[2];
        return {
            email: "",
            ticket: "INV-003",
            transaction_at: new Date().toDatetimeLocalInputValue(),
            payment: "現金",
            selectedMenuId: "",
            selectedMenuItem: {},
            selectedPrice: "",
            selectedQuantity: "",
            selectedInitStatus: 0,
            selectDiscountType: 0,
            discountNum: 0,
            isDiscount: false, // 是否要使用折扣
            hasDiscountNumError: false,

            menus: JSON.parse(document.querySelector("input[name=menu]").value),
            uuid: uuid,
            inventories: {},
            form: {},
            inputErrs: {},
            subtotal: 0,
            totalPrice: 0,
            note: "",
            discount: 0,
        };
    },

    computed: {
        selectedItemTotal: (vm) => vm.selectedQuantity * vm.selectedPrice,
    },

    mounted() {
        this.form = new Form("invoice");
        this.form.items = [];
    },

    validators: {
        selectedMenuId: function (value) {
            return ItemValidator.value(value).required("請選擇購買產品");
        },
        selectedQuantity(value) {
            return ItemValidator.value(value).integer().greaterThan(0).required();
        },
    },

    methods: {
        DateTime(offset) {
            let d = new Date();
            d.setUTCHours(offset);
            return d.toISOString().split(".")[0];
        },

        onSubmit(e) {
            if (this.hasDiscountNumError) {
                e.preventDefault();
                return;
            }
            if (this.form.items.length < 1) {
                this.$swal({
                    title: "本次交易沒有購買項目",
                    icon: "error",
                    text: "請加入購買品項",
                });
                return;
            }

            let formData = {
                ticket: this.ticket,
                payment: this.payment,
                transaction_at: this.transaction_at,
                items: this.form.items,
                price: Math.abs(this.totalPrice),
                note: this.note,
                discount: Math.abs(this.discount),
            };

            axios({
                    method: "POST",
                    url: `/api/customers/${this.uuid}/transactions/`,
                    data: formData,
                    headers: {
                        //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json",
                    },
                })
                .then((res) => {
                    this.$swal({
                        title: "新增成功",
                        text: "稍後重新整理",
                        icon: "success",
                        timer: 900,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload();
                    });
                })
                .catch((e) => {
                    this.$swal({
                        title: "新增失敗",
                        icon: "error",
                        text: e,
                    });
                });
        },

        onAddItem() {
            let self = this;

            this.$validate().then(function (success) {
                if (!success) {
                    console.log("Validator Failed");
                    return;
                }

                const buyItem = {
                    itemId: self.selectedMenuId,
                    itemName: self.selectedMenuItem.name,
                    price: self.selectedPrice,
                    quantity: self.selectedQuantity,
                    itemTotal: self.selectedItemTotal,
                    initStatus: self.selectedInitStatus,
                };

                self.form.items.push(buyItem);
                self.updateTotalPrice();
                self.inputErrs = self.selectedMenuItem = {};
                self.selectedMenuId = self.selectedPrice = self.selectedQuantity = "";
                self.selectedItemTotal = "";

                self.validation.reset();
            });
        },

        onDeleteItem(index) {
            this.form.items.splice(index, 1);
            this.updateTotalPrice();
        },

        onSelectItem(menuId, index) {
            let item = this.menus.find((element, index, array) => {
                return element.id == this.selectedMenuId;
            });

            this.selectedMenuItem = item;
            this.selectedPrice = item.price;
            this.selectedQuantity = 1;
            this.selectedItemTotal = item.price;
            this.selectedInitStatus = item.init_status;
        },

        onUpdateDiscount(index) {
            if (this.discountNum != 0) {
                this.discountNum = this.discountNum.replace(/^0+/, "");
            }

            if (!this.validateDiscount()) {
                this.discountNum = this.discount = 0;
                return;
            }

            if (this.selectDiscountType == "percent") {
                this.discount = Math.ceil((this.subtotal * this.discountNum) / 100);
            } else {
                this.discount = this.discountNum;
            }

            let updatePrice = this.subtotal - this.discount;
            this.totalPrice = updatePrice > 0 ? updatePrice : 0;
            this.discount = this.discount > 0 ? this.discount * -1 : this.discount; // for display, must be back when form submit
        },

        resetDiscount() {
            this.totalPrice = this.subtotal;
            this.discount = this.discountNum = 0;
            this.isDiscount = !this.isDiscount;
        },

        updateTotalPrice() {
            this.subtotal = 0;
            this.form.items.forEach((element) => {
                this.subtotal += element.itemTotal;
            });
            this.totalPrice = this.subtotal;
        },

        validateDiscount() {
            // #FIXME, better to set two unique validator for verification
            let isValid = false;
            if (this.selectDiscountType == "percent") {
                isValid = this.discountNum >= 0 && this.discountNum <= 100;
            } else {
                isValid = this.discountNum > 0 && this.discountNum <= this.subtotal;
            }

            this.hasDiscountNumError = !isValid;
            return isValid;
        },
    },
};
</script>

<template>
    <div class="card-body description">

        <form method="POST" action="" accept-charset="UTF-8" id="invoice" role="form" novalidate="novalidate"
            enctype="multipart/form-data">
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
                        <div class="form-group col-md">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center border-right-0 border-bottom-0" scope="col">品項</th>
                                        <th class="text-center border-right-0 border-bottom-0" scope="col">數量</th>
                                        <th class="text-center border-right-0 border-bottom-0" scope="col">單價</th>
                                        <th class="text-center border-right-0 border-bottom-0" scope="col">總計</th>
                                        <th class="text-center border-right-0 border-bottom-0" scope="col">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control" @change="onSelectItem"
                                                v-model="selectedMenuId">
                                                <option disabled value="">請選擇品項</option>
                                                <option v-for="(menu) in menus" v-bind:value="menu.value"
                                                    :value="menu.id" :key="menu.id">
                                                    {{ menu.name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control text-center" type="number"
                                                v-model="selectedQuantity">
                                        </td>
                                        <td>
                                            <input class="form-control text-center" type="number"
                                                v-model="selectedSalePrice">
                                        </td>
                                        <td>
                                            <input class="form-control text-center" data-item="item_total" type="number"
                                                :value="selectedItemTotal">
                                        </td>
                                        <td class="text-center border-right-0 border-bottom-0">
                                            <button class="btn btn-icon btn-outline-success btn-lg" type="button"
                                                @click="onAddItem" data-toggle="tooltip" title="選擇品項並新增">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>

                                    <th class="text-center border-right-0 border-bottom-0" scope="col">品項</th>
                                    <th class="text-center border-right-0 border-bottom-0" scope="col">數量</th>
                                    <th class="text-center border-right-0 border-bottom-0" scope="col">單價</th>
                                    <th class="text-center border-right-0 border-bottom-0" scope="col">總計</th>
                                    <th class="text-center border-right-0 border-bottom-0" scope="col">刪除</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in form.items" :index="index">
                                    <td class="text-center">{{ row.itemName }}</td>
                                    <td class="text-center">{{ row.quantity }}</td>
                                    <td class="text-center">{{ row.salePrice }}</td>
                                    <td class="text-center">{{ row.itemTotal }}</td>
                                    <td class="text-center border-right-0 border-bottom-0">
                                        <button class="btn btn-icon btn-outline-danger btn-sm" type="button"
                                            @click="onDeleteItem(index)" data-toggle="tooltip" title="刪除項目">
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
                                        <a href="#" disabled data-toggle="tooltip"
                                            title="尚未開放"><strong>新增折扣</strong></a>
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

</template>
<script>
    import Form from './../../plugins/form';
    export default {
        data: function () {
            let url = new URL(window.location.href),
                uuid = url.pathname.split('/')[2]

            return {
                selectedMenuId: '',
                selectedMenuItem: {},
                selectedSalePrice: '',
                selectedQuantity: '',

                menus: [],
                uuid: uuid,
                inventories: {},
                form: {},
                totalPrice: 0,
            };
        },

        computed: {
            selectedItemTotal: {
                get: function () {
                    return this.selectedQuantity * this.selectedSalePrice;
                }
            },

            finalPrice: {
                get: function () {
                    return this.totalPrice;
                }
            },
        },

        mounted() {
            this.loadMenus();
            this.form = new Form('invoice');
            this.form.items = [];
        },

        methods: {
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

            onAddItem() {
                const buyItem = {
                    "itemId": this.selectedMenuId,
                    "itemName": this.selectedMenuItem.name,
                    "salePrice": this.selectedSalePrice,
                    "quantity": this.selectedQuantity,
                    "itemTotal": this.selectedItemTotal
                }

                this.form.items.push(buyItem);
                this.updateTotalPrice();

                this.selectedMenuId = '';
                this.selectedMenuItem = {};
                this.selectedSalePrice = '';
                this.selectedQuantity = '';
                this.selectedItemTotal = '';
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
                this.selectedSalePrice = item.sale_price;
                this.selectedQuantity = 1;
                this.selectedItemTotal = item.sale_price;
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

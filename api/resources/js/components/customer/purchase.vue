<template>
    <div class="card-body description">
    <form method="POST" action="" accept-charset="UTF-8" id="invoice" role="form" novalidate="novalidate" enctype="multipart/form-data">
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
                                <th class="text-center border-right-0 border-bottom-0" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" @change="onSelectItem" v-model="buy.menuId">
                                        <option disabled value="">請選擇品項</option>
                                        <option v-for="(menu) in menus" v-bind:value="menu.value" :value="menu.id" :key="menu.id">
                                            {{ menu.name }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control text-center" @change="onCalculateItemTotal" type="number" :value="buy.quantity">
                                </td>
                                <td>
                                    <input class="form-control text-center" @change="onCalculateItemTotal" type="number" :value="buy.purchase_price">
                                </td>
                                <td>
                                    <input class="form-control text-center" data-item="item_total" type="number" :value="buy.item_total">
                                </td>
                                 <td class="text-center border-right-0 border-bottom-0">
                                    <button class="btn btn-icon btn-outline-success btn-lg" :disabled="buy.menuId == ''" type="button" @click="onAddItem" data-toggle="tooltip" title="選擇品項並新增">
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
                                <th class="text-center border-right-0 border-bottom-0" scope="col"></th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">品項</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">數量</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">單價</th>
                                <th class="text-center border-right-0 border-bottom-0" scope="col">總計</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in form.items" :index="index">
                                <td class="text-center border-right-0 border-bottom-0">
                                    <button class="btn btn-icon btn-outline-danger btn-lg" type="button" @click="onDeleteItem(index)" data-toggle="tooltip" title="刪除項目">
                                    <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td>{{ row.item_name }}</td>
                                <td>{{ row.quantity }}</td>
                                <td>{{ row.purchase_price }}</td>
                                <td>{{ row.item_total }}</td>
                            </tr>

                            <tr id="tr-subtotal">
                                <td colspan="4" class="text-right border-right-0 border-bottom-0"><strong>小計</strong>
                                </td>
                                <td class="text-center border-bottom-0 long-texts">0</td>
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
                                <td class="text-center">0</td>
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
  data: function() {
    let url = new URL(window.location.href),
        uuid = url.pathname.split('/')[2]

    return {
      menuSelected: '',
      menus: [],
      uuid: uuid,
      inventories: {},
      form: {},
      buy: {
          menuId: '',
          quantity: '',
          purchase_price: 0,
          item_total: 0,
      }
    };
  },

  mounted() {
      this.loadMenus();
      this.form = new Form('invoice');
      this.form.items = [];

      if (typeof invoice_items !== 'undefined' && invoice_items) {
            let items = [];
            let item_backup = this.form.item_backup[0];
            let currency_code = this.form.currency_code;

            this.edit.status = true;

            invoice_items.forEach(function(item) {
                console.log(item);
                /*items.push({
                    show: false,
                    currency: currency_code,
                    item_id: item.item_id,
                    name: item.name,
                    price: (item.price).toFixed(2),
                    quantity: item.quantity,
                    tax_id: item.tax_id,
                    discount: item.discount_rate,
                    total: (item.total).toFixed(2)
                });*/
            });

            this.form.items = items;
        }
  },

  methods: {
    loadMenus: function() {
      axios
        .get(`/api/menus/`)
        .then((res) => {
            this.menus = res.data.data;
        })
        .catch((res) => {
            console.log("Menus load failed.")
        });
    },
    loadInventories: function() {
      axios
        .get(`/api/customers/${$this.uuid}inventories`)
        .then((res) => {
            this.inventories = this.res.data.data;

        })
        .catch((res) => {
            alert("something is wrong")
        });
    },

    onAddItem() {
        this.form.items.push({
            "item_id": this.buy.menuId,
            "item_name": this.buy.item.name,
            "purchase_price": (this.buy.purchase_price).toFixed(2),
            "quantity": this.buy.quantity,
            "item_total":  (this.buy.purchase_price).toFixed(2),
        })
        console.log(this.form.items);
        this.buy.menuId = '';
    },

    onDeleteItem(index) {
        console.log(index)
        this.form.items.splice(index, 1);
        console.log(this.form.items);
    },

    onSelectItem(menuId, index) {
        let item = this.menus.find((element, index, array) => {
            return element.id == this.buy.menuId;
        })
        this.buy.item = item;
        this.buy.purchase_price = item.purchase_price;
        this.buy.quantity = 1;
        this.buy.item_total = (item.purchase_price);
    },
    onCalculateItemTotal() {
        this.buy.item_total = this.buy.quantity * this.buy.purchase_price;
    }
  }
};
</script>
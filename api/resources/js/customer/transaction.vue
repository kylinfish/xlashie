<template>
<div class="card-body">
    <table class="table table-sm table-hover table-bordered table-responsive-sm">
        <thead class="thead-light">
            <tr>
                <th class="text-center">訂單編號</th>
                <th class="text-center">消費日期</th>
                <th class="text-center">消費金額</th>
                <th class="text-center">付款方式</th>
                <th class="text-center">操作</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="transaction, index in transactions">
                <td class="text-center w-5">{{ transaction.id }}</td>
                <td class="text-center w-10">{{ transaction.created_at }}</td>
                <td class="text-center">{{ transaction.price | formatNumber }}</td>
                <td class="text-center">{{ transaction.payment }}</td>
                <td class="text-center">
                    <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#transaction-modal" @click="fillModal(transaction.id)">
                        <span class="btn-inner--icon">
                            <i class="ni ni-settings-gear-65"></i>
                        </span>
                        檢視
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade" id="transaction-modal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-modal="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">交易紀錄 - {{ selectedItem.created_at }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-6">支付金額:</label>
                                <p class="col-6">{{ selectedItem.price | formatNumber }}</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-6">付款方式:</label>
                                <p class="col-6">{{ selectedItem.payment }}</p>
                            </div>
                        </div>

                        <!--
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-6">折扣金額:</label>
                                <p class="col-6">{{ selectedItem.discount }}</p>
                            </div>
                        </div>
                        -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-12">訂單備註:</label>
                                <textarea class="form-control" rows="2" v-model="selectedItem.note"></textarea>
                            </div>
                        </div>
                        <table class="table align-items-center table-striped table-bordered table-hover">
                            <thead class="text-white bg-gradient-light">
                                <th>產品</th>
                                <th>數量</th>
                                <th>單價</th>
                            </thead>
                            <tbody>
                                <tr v-for="detail in tDetail">
                                    <td> {{ detail.product_name }}</td>
                                    <td> {{ detail.quantity | formatNumber }}</td>
                                    <td> {{ detail.unit_price | formatNumber }}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
Vue.filter("formatNumber", (v) => {
    return new Intl.NumberFormat().format(v)
})
export default {
    data: function () {
        let url = new URL(window.location.href);
        let uuid = url.pathname.split("/")[2];

        return {
            uuid: uuid,
            transactions: {},
            selectedItem: {},
            tDetail: {},
        };
    },

    mounted() {
        this.loadTickets();
    },

    methods: {
        loadTickets: function () {
            axios
                .get(`/api/customers/${this.uuid}/transactions`)
                .then((res) => {
                    this.transactions = res.data.data;
                })
                .catch((res) => {
                    console.log("something is wrong", res);
                });
        },
        fillModal(i_id) {

            let inventory = this.transactions.filter((inventory) => inventory.id == i_id)[0];

            this.selectedItem = Object.assign({}, inventory);
            this.loadTicketDetail(i_id);
        },
        loadTicketDetail(t_id) {
            axios
                .get(`/api/customers/${this.uuid}/transactions/${t_id}`)
                .then((res) => {
                    this.tDetail = res.data;
                })
                .catch((res) => {
                    console.log("something is wrong", res);
                });
        },
    },
};
</script>

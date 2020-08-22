<template>
<div class="card-body description">
    <table class="table table-sm table-hover table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">訂單編號</th>
                <th class="text-center">消費金額</th>
                <th class="text-center">付款方式</th>
                <th class="text-center">消費日期</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="transaction, index in transactions">
                <td class="text-center">
                    <a href="#">{{ index + 1 }}</a>
                </td>
                <td class="text-center w-50">
                    <a href="#" role="button" data-toggle="modal" data-target="#transaction-modal" @click="fillModal(transaction.id)">
                        <span class="btn-inner--icon">
                            <i class="ni ni-settings-gear-65"></i>
                        </span>
                        {{ transaction.ticket }}
                    </a>
                </td>
                <td class="text-center">{{ transaction.price }}</td>
                <td class="text-center">{{ transaction.payment }}</td>
                <td class="text-center w-15">{{ transaction.created_at }}</td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade" id="transaction-modal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-modal="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ selectedItem.created_at }} - 交易紀錄</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-md-3">付款方式:</label> <p class="col-md-3">{{ selectedItem.payment }}</p>
                        <label class="col-md-3">繳款金額:</label> <p class="col-md-3">{{ selectedItem.price }}</p>
                        <label class="col-md-3">折扣金額:</label> <p class="col-md-3">{{ selectedItem.discount }}</p>

                        <table class="table align-items-center table-striped table-bordered table-hover">
                            <thead class="text-white bg-gradient-light">
                                <th>產品</th>
                                <th>數量</th>
                                <th>單價</th>
                            </thead>
                            <tbody>
                            <tr v-for="detail in tDetail">
                                <td> {{ detail.product_name }}</td>
                                <td> {{ detail.quantity }}</td>
                                <td> {{ detail.unit_price }}</td>
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

<template>
    <div class="card-body description">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">訂單編號</th>
                    <th class="text-center">消費金額</th>
                    <th class="text-center">付款方式</th>
                    <th class="text-center">消費日期</th>
                    <th class="text-center">動作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction, index in transactions">
                    <td class="text-center"><a href="#">{{ index + 1 }}</a></td>
                    <td class="text-center w-50"><a href="#">{{ transaction.ticket }}</a></td>
                    <td class="text-center">{{ transaction.price }}</td>
                    <td class="text-center">{{ transaction.payment }}</td>
                    <td class="text-center w-15">{{ transaction.created_at }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn btn-neutral btn-sm text-light items-align-center py-2"><i
                                    class="fa fa-ellipsis-h text-muted"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><a href="#"
                                    class="dropdown-item">顯示</a> <a href="#" class="dropdown-item">編輯</a>
                                <div class="dropdown-divider"></div> <button type="button" title="刪除"
                                    class="dropdown-item action-delete">刪除</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>
<script>
    export default {
        data: function () {
            let url = new URL(window.location.href)
            let uuid = url.pathname.split('/')[2]

            return {
                uuid: uuid,
                transactions: {}
            };
        },

        mounted() {
            this.loadTickets()
        },

        methods: {
            loadTickets: function () {
                axios
                    .get(`/api/customers/${this.uuid}/transactions`)
                    .then((res) => {
                        this.transactions = res.data.data;
                    })
                    .catch((res) => {
                        console.log("something is wrong", res)
                    });
            }
        }
    };
</script>

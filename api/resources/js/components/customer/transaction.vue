<template>
    <div class="card-body description">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th class="col-md-3 text-center">訂單編號</th>
                    <th class="col-md-3 text-center">消費金額</th>
                    <th class="col-md-3 text-center">消費日期</th>
                    <th class="col-md-3 text-center">付款方式</th>
                    <th class="col-md-3 text-center">動作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket, index in tickets">
                    <td class="col-md-3 text-center"><a href="#">{{ index + 1 }}</a></td>
                    <td class="col-md-3 text-center">{{ ticket.purchase_price }}</td>
                    <td class="col-md-3 text-center">{{ ticket.created_at }}</span></td>
                    <td class="col-md-3 text-center">{{ ticket.pay_type }}</td>
                    <td class="col-md-2text-center">
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
                tickets: {}
            };
        },

        mounted() {
            this.loadTickets()
        },

        methods: {
            loadTickets: function () {
                axios
                    .get(`/api/customers/${this.uuid}/tickets`)
                    .then((res) => {
                        this.tickets = res.data.data;
                    })
                    .catch((res) => {
                        console.log("something is wrong", res)
                    });
            }
        }
    };
</script>

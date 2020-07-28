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
             <tr v-for="order in orders">
                <td class="col-md-3 text-center"><a href="#">{{ order.ticket }}</a></td>
                <td class="col-md-3 text-center">{{ order.purchase_price }}</td>
                <td class="col-md-3 text-center">{{ order.created_at }}</span></td>
                <td class="col-md-3 text-center">{{ order.pay_type }}</td>
                <td class="col-md-2text-center">
                    <div class="dropdown">
                        <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="btn btn-neutral btn-sm text-light items-align-center py-2"><i
                                class="fa fa-ellipsis-h text-muted"></i>
                            </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><a
                                href="#" class="dropdown-item">顯示</a> <a
                                href="#" class="dropdown-item">編輯</a>
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
  data: function() {
    let url = new URL(window.location.href)
    let uuid = url.pathname.split('/')[2]

    return {
      loading: true,
      uuid: uuid,
      orders: {}
    };
  },

  mounted() {
      //this.loadOrders()
  },

  methods: {
    loadOrders: function() {
      axios
        .get(`/api/customers/${this.uuid}/orders`)
        .then((res) => {
            this.orders = this.res.data.data;
        })
        .catch((res) => {
            alert("something is wrong")
        });
        this.loading = false;
    }
  }
};
</script>
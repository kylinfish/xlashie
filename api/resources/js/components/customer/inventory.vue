<template>
    <div class="card-body description">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">#</th>
                    <th class="col-md-3 text-center">產品名稱</th>
                    <th class="col-md-3 text-center">狀態</th>
                    <th class="col-md-3 text-center">購買日期</th>
                    <th class="col-md-3 text-center">使用日期</th>
                    <th class="col-md-3 text-center">動作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="inventory, index in inventories">
                    <td class="text-center">{{ index + 1 }}</td>
                    <td class="col-md-3 text-center">{{ inventory.product_name }}</td>
                    <td class="col-md-3 text-center">
                        <span class="badge badge-pill badge-success">{{ inventory.status }}</span>
                    </td>
                    <td class="col-md-3 text-center">{{ inventory.created_at }}</td>
                    <td class="col-md-3 text-center">{{ inventory.used_at }}</td>
                    <td class="col-md-2 text-center">
                        <div class="dropdown">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn btn-neutral btn-sm text-light items-align-center py-2">
                                <i class="fa fa-ellipsis-h text-muted"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a href="#" class="dropdown-item" data-toggle="modal"
                                    data-target="#inventory-status-modal">核銷</a>
                                <a href="#" class="dropdown-item">編輯</a>
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
                loading: true,
                uuid: uuid,
                inventories: {}
            };
        },

        mounted() {
            this.loadInventories();
        },

        methods: {
            loadInventories: function () {
                axios
                    .get(`/api/customers/${this.uuid}/inventories`)
                    .then((res) => {
                        this.inventories = res.data.data;
                    })
                    .catch((res) => {
                        console.log(res)
                        console.log("inventory: something is wrong")
                    });
            }
        }
    };

</script>
<template>
<div class="card-body description">
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th class="text-center">#</th>
                <th class="col-md-3 text-center">產品名稱</th>
                <th class="col-md-3 text-center">狀態</th>
                <th class="col-md-3 text-center">購買日期</th>
                <th class="col-md-3 text-center">備註</th>
                <th class="col-md-3 text-center">動作</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="inventory, index in inventories">
                <td class="text-center">{{ index + 1 }}</td>
                <td class="col-md-3 text-center">{{ inventory.product_name }}</td>
                <td class="col-md-3 text-center">
                    <span :class="['form-badge badge-pill', inventory.badgeStyle]" class="">{{ inventory.status_str }}</span>
                </td>
                <td class="col-md-3 text-center">{{ inventory.created_at }}</td>
                <td class="col-md-3 text-center" style="{white-space: nowrap;text-overflow:ellipsis;width:15px;overflow:hidden;}">{{ inventory.note }}</td>
                <td class="col-md-2 text-center">
                    <a href="#" role="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#inventory-status-modal" @click="fillModal(inventory.id)"><span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span> 核銷</a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="modal" id="inventory-status-modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="pt-3">
                            <div class="text-muted text-center mt-2 mb-3">
                                <h3 class="text-blue">商品資訊</h3>
                            </div>
                            <dl class="row">
                                <dd class="col-md-12 text-center"><span class="h3">{{ selectedItem.product_name }}</span></dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4 text-right h4">購買日期</dt>
                                <dd class="col-sm-8 text-center h4">{{ selectedItem.created_at }}</dd>
                            </dl>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-muted mb-3">
                                <h3 class="text-blue">核銷</h3>
                            </div>
                            <form role="form" @submit.prevent="onSubmit">
                                <div class="form-group-sm">
                                    <label class="form-control-label">更新日期</label>
                                    <input class="form-control" type="datetime-local"  step="1"
                                    v-model="selectedItem.use_at">
                                </div>

                                <div class="form-group-sm">
                                    <label class="form-control-label">核銷狀態</label>
                                    <select class="form-control" v-model="selectedItem.status">
                                        <option value="0"><span>未使用</span></option>
                                        <option value="1"><span>已發放</span></option>
                                        <option value="2"><span>已使用</span></option>
                                        <option value="3"><span>積欠未發</span></option>
                                        <option value="4"><span>註銷失效</span></option>
                                    </select>
                                </div>

                                <div class="form-group-sm">
                                    <label class="form-control-label">備註說明</label>
                                    <textarea class="form-control" rows="3" maxlength="255" placeholder="最多 255 個字" v-model="selectedItem.note"></textarea>
                                </div>
                                <div class="offset-md-5 mt-3">
                                    <button type="submit" class="btn btn-primary my-4">送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import VueSweetalert2 from 'vue-sweetalert2';
export default {
    data: function () {
        let url = new URL(window.location.href)
        let uuid = url.pathname.split('/')[2]

        return {
            currentTime: new Date().toDatetimeLocalInputValue(),
            isShowModal: true,
            loading: true,
            uuid: uuid,
            inventories: {},
            selectedItem: {},
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
                    let statusMap = {
                        0: 'badge-secondary',
                        1: 'badge-success',
                        2: 'badge-success',
                        3: 'badge-warning',
                        4: 'badge-secondary'
                    }
                    this.inventories = res.data.data
                    this.inventories.forEach((inventory) => {
                        inventory.badgeStyle = statusMap[inventory.status]
                    });
                })
                .catch((res) => {
                    console.log(res)
                    console.log("inventory: something is wrong")
                });
        },
        fillModal(i_id) {
            let inventory = this.inventories.filter(inventory => inventory.id == i_id)[0];

            this.selectedItem = inventory
            if (!inventory.use_at) {
                this.selectedItem.use_at = this.currentTime;
            }
        },
        onSubmit() {
            axios({
                method: "PUT",
                url: `/api/customers/${this.uuid}/inventories/status`,
                data: this.selectedItem,
                headers: {
                    //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                }
            })
            .then((res) => {
                this.$swal({
                    title: "修改成功",
                    icon: "success",
                    timer: 900,
                    showConfirmButton: false
                })
                this.loadInventories()
                $('#inventory-status-modal').modal('hide');

            })
            .catch((e) => {
                this.$swal({
                    title: "修改失敗",
                    icon: "error",
                    text: e,
                })
            });
        },
    }
};
</script>

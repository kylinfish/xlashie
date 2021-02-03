<template>
<div class="card-body">
    <div class=" table-responsive">
        <table class="table table-hover table-bordered align-items-center table-sm">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">訂單編號</th>
                    <th class="text-center">消費日期</th>
                    <th class="text-center">產品名稱</th>
                    <th class="text-center">狀態</th>
                    <th class="text-center">核銷日期</th>
                    <th class="text-center">操作</th>
                    <th class="text-center">筆記</th>
                </tr>
            </thead>
            <tbody class="list">
                <tr v-for="inventory, index in inventories">
                    <td class="text-center w-5">{{ inventory.order_id }}</td>
                    <td class="text-center w-10">{{ inventory.created_at }}</td>
                    <td class="text-center">{{ inventory.product_name }}</td>
                    <td class="text-center">
                        <span :class="['form-badge badge-pill', inventory.badgeStyle]">{{ inventory.status_str }}</span>
                    </td>
                    <td class="text-center">{{ inventory.use_at | formatISOStr }}</td>
                    <td class="text-center w-10">
                        <button v-show="inventory.use_at == null" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#inventory-status-modal" @click="fillInventoryModal(inventory.id)"><i class="ni ni-settings-gear-65"></i> 核銷</button>

                        <button v-show="inventory.use_at != null" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#inventory-status-modal" @click="fillInventoryModal(inventory.id)"><i class="ni ni-settings-gear-65"></i> 核銷</button>
                    </td>
                    <td class="text-center w-10">
                        <a v-show="!inventory.note_id" href="#" role="button" class="btn btn-sm btn-outline-default" data-toggle="modal" data-target="#note-modal" @click="fillNoteModal(inventory.id)"><span class="btn-inner--icon"><i class="fa fa-file-alt"></i></span> 新增</a>

                        <a v-show="inventory.note_id" href="#" role="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#note-modal" @click="fillNoteModal(inventory.id)"><span class="btn-inner--icon"><i class="fa fa-file-alt"></i></span> 檢視</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

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
                                    <input class="form-control" type="datetime-local" step="1" v-model="selectedItem.use_at">
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

    <div class="modal" id="note-modal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification" v-text="noteModalTitle"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="col" v-show="isUseEditor">
                        <div class="text-center">
                            <quill-editor class="qleditor" :content="content" @change="onEditorChange($event)" />
                        </div>
                    </div>
                    <div v-show="! isUseEditor">
                        <div class="col">
                            <div class="form-group py-2 ql-editor">
                                <pre v-html="showContent"></pre>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button button type="button" class="btn btn-link mr-auto" data-dismiss="modal">關閉</button>
                    <button class="btn btn-outline-danger col-md-2 float-right mr-3" @click="onDeleteNote" v-show="isUseEditor && !isNoteCreate">刪除</button>
                    <button class="btn btn-warning col-md-2 float-right" @click="onUpdateNote" v-show="isUseEditor && !isNoteCreate">修改</button>
                    <button class="btn btn-success col-md-2 float-right" @click="onSubmitNote" :disabled="this.content === ''" v-show="isUseEditor && isNoteCreate">新增</button>

                    <button class="btn btn-info col-md-2 float-right mr-3" @click="fillNoteToQuill" v-show="!isUseEditor &&!isNoteCreate">更新</button>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
import VueQuillEditor from "vue-quill-editor";

Vue.use(VueQuillEditor /* { default global options } */ );
Vue.filter("formatISOStr", (v) => {
    return (v ? v.replace("T", " ") : v);
})
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

            isUseEditor: false,
            isNoteCreate: false,
            editeNote: "",
            noteModalTitle: "",

            selectedNoteId: "",
            selectedInventoryId: "",
            content: "",
            showContent: "",
            showId: 0,
            showInventory: "",
        };
    },

    mounted: function () {
        this.loadInventories();
    },

    computed: {
        editor() {
            return this.$refs.myQuillEditor.quill;
        },
    },

    methods: {
        closeEvent: function () {

        },
        loadInventories: function () {
            axios
                .get(`/api/customers/${this.uuid}/inventories`)
                .then((res) => {
                    let statusMap = {
                        0: 'badge-secondary',
                        1: 'badge-primary',
                        2: 'badge-primary',
                        3: 'badge-danger',
                        4: 'badge-warning'
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
        fillInventoryModal(iid) {
            let inventory = this.inventories.filter(inventory => inventory.id == iid)[0];

            this.selectedItem = Object.assign({}, inventory)
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
                    $('#inventory-status-modal').modal('hide')
                    this.loadInventories()

                })
                .catch((e) => {
                    this.$swal({
                        title: "修改失敗",
                        icon: "error",
                        text: e,
                    })
                });
        },

        onEditorChange({
            quill,
            html,
            text
        }) {
            this.content = html;
        },

        fillNoteModal(iid) {
            $('#note-modal').modal('hide')
            let inventory = this.inventories.filter(inventory => inventory.id == iid)[0];
            this.selectedInventoryId = inventory.id;
            this.selectedNoteId = inventory.note_id;
            this.noteModalTitle = inventory.product_name + " - " + inventory.created_at

            if (inventory.note_id) {
                axios
                    .get(`/api/customers/${this.uuid}/notes/${inventory.note_id}`)
                    .then((res) => {
                        this.showContent = this.content = res.data.data.note;
                        this.isUseEditor = this.isNoteCreate = false;
                    })
                    .catch((res) => {
                        console.log(res);
                        console.log("Note: something is wrong");
                    });
            } else {
                this.isUseEditor = this.isNoteCreate = true;
                this.content = '';
            }
        },
        fillNoteToQuill() {
            this.content = this.showContent;
            this.isUseEditor = true;
            this.isNoteCreate = false;
        },

        onSubmitNote() {
            if (this.content == "") {
                this.$swal({
                    title: "請填寫內容再送出",
                    icon: "warning"
                });
                return;
            }
            axios({
                    method: "POST",
                    url: `/api/customers/${this.uuid}/notes/`,
                    data: {
                        inventory_id: this.selectedInventoryId,
                        note: this.content,
                    },
                    headers: {
                        //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json",
                    },
                })
                .then((res) => {
                    this.$swal({
                        title: "新增成功",
                        icon: "success",
                        timer: 900,
                        showConfirmButton: false,
                    });
                    $('#note-modal').modal('hide')
                    this.loadInventories();
                })
                .catch((e) => {
                    this.$swal({
                        title: "新增失敗",
                        icon: "error",
                        text: e
                    });
                });
        },

        onUpdateNote() {
            axios({
                    method: "PUT",
                    url: `/api/customers/${this.uuid}/notes/${this.selectedNoteId}`,
                    data: {
                        inventory_id: this.selectedInventoryId,
                        note: this.content,
                    },
                    headers: {
                        //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json",
                    },
                })
                .then((res) => {
                    this.$swal({
                        title: "修改成功",
                        icon: "success",
                        timer: 900,
                        showConfirmButton: false,
                    });
                    $('#note-modal').modal('hide')
                })
                .catch((e) => {
                    this.$swal({
                        title: "修改失敗",
                        icon: "error",
                        text: e
                    });
                });
        },

        onDeleteNote() {
            this.$swal({
                title: "確定要刪除該筆記嗎?",
                text: "注意，無法復原",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "是",
                cancelButtonText: "否",
            }).then((result) => {
                if (!result.value) {
                    return;
                }
                axios({
                        method: "DELETE",
                        url: `/api/customers/${this.uuid}/notes/${this.selectedNoteId}`,
                        data: {
                            inventory_id: this.selectedInventoryId,
                        },
                        headers: {
                            //'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json",
                        },
                    })
                    .then((res) => {
                        this.$swal({
                            title: "刪除成功",
                            icon: "success",
                            timer: 900,
                            showConfirmButton: false,
                        });
                        $('#note-modal').modal('hide')
                        this.loadInventories();
                    })
                    .catch((e) => {
                        this.$swal({
                            title: "刪除失敗",
                            icon: "error",
                            text: e
                        });
                    });
            });
        }
    }
};
</script>

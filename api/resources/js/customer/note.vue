<template>
  <div class="row min-height-40">
    <div class="col-md-3 pl-4">
      <button
        v-show="!isCreating"
        @click="openEditPanel(true)"
        type="button"
        class="btn btn-block btn-outline-default mt-2"
      >新增客戶筆記</button>
      <button
        v-show="isCreating"
        @click="closeEditPanel"
        type="button"
        class="btn btn-block btn-outline-warning mt-2"
      >取消此次修改</button>
      <div v-show="!isCreating" class="item-scroll">
        <div class="list-group mt-2" v-for="(note) in notes">
          <a
            href="#"
            :class="['h4 text-nowrap list-group-item list-group-item-action', {'list-group-item-primary': note.isActive}]"
            @click="changeEditorContent(note.id)"
          >{{note.created_at}}<span class="ml-1 badge badge-primary" v-show="note.inventory_id"><i class="fa fa-box"></i></span></a>
        </div>
      </div>
    </div>

    <div class="col-md-9 pt-3 pr-4">
      <div class="col" v-show="isShowCreatePanel">
        <div class="form-group">
          <button
            class="btn btn-info btn-sm col-md-2 float-right"
            @click="onUpdate"
            v-show="!isInitial"
          >更新</button>
          <button
            class="btn btn-success btn-sm col-md-2 float-right"
            @click="onSubmit"
            :disabled="this.content === ''"
            v-show="isInitial"
          >新增</button>
          <button
            class="btn btn-danger btn-sm col-md-2 float-right mr-3"
            @click="onDelete"
            v-show="!isInitial"
          >刪除</button>

          <span class="h3 text-green pr-3">綁定客戶庫存品項?</span>
          <label class="custom-toggle custom-toggle-success mb--2">
            <input type="checkbox" checked v-model="isBind" />
            <span class="custom-toggle-slider rounded-circle" data-label-off="否" data-label-on="是"></span>
          </label>

          <select
            class="form-control-sm col-md-12 mt-2 mb-3"
            :disabled="!isBind"
            v-model="selectedInvId"
          >
            <option value="0">請選擇</option>
            <option
              v-for="(inventory) in inventories"
              v-bind:value="inventory.value"
              :value="inventory.id"
              :key="inventory.id"
            >{{ inventory.created_at}} - {{ inventory.product_name }}</option>
          </select>

          <!-- Or manually control the data synchronization -->
          <quill-editor
            class="qleditor"
            :content="content"
            :options="editorOption"
            @change="onEditorChange($event)"
          />
        </div>
      </div>

      <div v-show="! isShowCreatePanel">
        <div v-if="showContent !== ''" class="col">
          <div class="mb-2">
            <button @click="onEdit" class="btn btn-warning btn-sm col-md-2 mt--1 float-right">修改</button>
            <h3>
              {{ showTitle }}
              <span class="badge badge-info mb-1 ml-4">{{ showInventory }}</span>
            </h3>
          </div>
          <div class="form-group bg-secondary">
            <span v-html="showContent"></span>
          </div>
        </div>
        <div v-else class="jumbotron bg-yellow text-center">
          <span class="alert-icon">
            <i class="fa fa-edit"></i>
          </span>
          <span class="h3">請 [新增筆記] 或選擇顯示左側任一筆紀錄</span>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.qleditor {
  height: 400px;
}
.min-height-40 {
  min-height: 40rem;
}
.item-scroll {
  height: 38rem;
  overflow-y: auto;
}
</style>
<script>
import Vue from "vue";
import VueQuillEditor from "vue-quill-editor";

import "quill/dist/quill.core.css"; // import styles
import "quill/dist/quill.snow.css"; // for snow theme
import "quill/dist/quill.bubble.css"; // for bubble theme

Vue.use(VueQuillEditor /* { default global options } */);

export default {
  data: function () {
    let url = new URL(window.location.href);
    let uuid = url.pathname.split("/")[2];

    return {
      uuid: uuid,
      isCreating: false,
      isShowCreatePanel: false,
      isBind: false,
      isInitial: false,
      inventories: {},
      notes: {},
      editeNote: "",

      editorOption: {},
      selectedInvId: "",
      content: "",
      showContent: "",
      showTitle: "",
      showId: 0,
      showInventory: "",
    };
  },

  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill;
    },
  },

  mounted() {
    this.loadInventories();
    this.loadNotes();
  },

  methods: {
    loadInventories: function () {
      axios
        .get(`/api/customers/${this.uuid}/inventories`)
        .then((res) => {
          this.inventories = res.data.data;
        })
        .catch((res) => {
          console.log(res);
        });
    },
    loadNotes: function () {
      axios
        .get(`/api/customers/${this.uuid}/notes`)
        .then((res) => {
          this.notes = res.data;
        })
        .catch((res) => {
          console.log(res);
          console.log("Note: something is wrong");
        });
    },
    changeEditorContent(id, isFillQuill = false) {
      this.showId = id;
      for (let i = 0; i < this.notes.length; i++) {
        this.notes[i].isActive = false;
        if (this.notes[i].id == id) {
          if (isFillQuill) {
            this.content = this.notes[i].note;
            this.selectedInvId = this.notes[i].inventory_id;
          } else {
            let iid = this.notes[i].inventory_id;
            let inventory = this.inventories.filter((inventory) => inventory.id == iid)[0];

            this.showInventory = inventory ? inventory.product_name : "";
            this.showTitle = this.notes[i].created_at;
            this.showContent = this.notes[i].note;
          }
          this.notes[i].isActive = true;
        }
      }
    },
    onEdit(id) {
      this.changeEditorContent(this.showId, true);
      this.openEditPanel();
      this.isBind = this.showInventory ? true : false;
    },
    onSubmit() {
      if (this.content == "") {
        this.$swal({ title: "請填寫內容再送出", icon: "warning" });
        return;
      }
      axios({
        method: "POST",
        url: `/api/customers/${this.uuid}/notes/`,
        data: {
          inventory_id: this.isBind ? this.selectedInvId : 0,
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
          this.isShowCreatePanel = false;
          this.isCreating = false;
          this.content = "";
          this.loadNotes();
        })
        .catch((e) => {
          this.$swal({title: "新增失敗", icon: "error", text: e});
        });
    },
    onUpdate() {
       axios({
        method: "PUT",
        url: `/api/customers/${this.uuid}/notes/${this.showId}`,
        data: {
          inventory_id: this.isBind ? this.selectedInvId : 0,
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
        this.isShowCreatePanel = false;
        this.isCreating = false;
        this.content = this.showContent = '';
        this.loadNotes();
      })
      .catch((e) => {
        this.$swal({title: "修改失敗", icon: "error", text: e});
      });
    },

    onEditorChange({ quill, html, text }) {
      this.content = html;
    },

    openEditPanel(isInitial = false) {
      this.isInitial = isInitial;
      this.isCreating = true;
      this.isShowCreatePanel = true;
    },

    closeEditPanel() {
      if (!this.content) {
        this.isBind = this.isCreating = this.isShowCreatePanel = false;
        this.selectedInvId = '';
      } else {
        this.$swal({
          title: "確定要放棄儲存嗎?",
          text: "離開後儲存內容會遺失喔",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "是",
          cancelButtonText: "否",
        }).then((result) => {
          if (result.value) {
            this.content = this.selectedInvId = '';
            this.isBind = this.isCreating = this.isShowCreatePanel = false;
          }
        });
      }
    },

    onDelete() {
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
          url: `/api/customers/${this.uuid}/notes/${this.showId}`,
          headers: {
            //'X-CSRF-TOKEN': window.Laravel.csrfToken,
            "X-Requested-With": "XMLHttpRequest",
            "Content-Type": "application/json",
          },
        })
        .then((res) => {
          this.isShowCreatePanel = false;
          this.isCreating = false;
          this.content = this.showContent = '';
          this.loadNotes();
        })
        .catch((e) => {
          this.$swal({title: "刪除失敗", icon: "error", text: e});
        });
      });
    }
  },
};
</script>
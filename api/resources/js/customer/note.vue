<template>
  <div class="row" :style="{ 'min-height': `40rem`}">
    <div class="col-md-3 pt-5 pl-4">
      <div class="list-group" v-for="(note) in notes">
        <a href="#"
          :class="['list-group-item list-group-item-action', {'active': note.isActive}]"
          @click="changeEditorContent(note.id)">{{note.created_at}}</a>
      </div>
    </div>

    <div class="col-md-9 pt-3 pr-4">
      <div class="form-group">

        <label class="custom-toggle custom-toggle-warning mb--3 float-right">
          <input type="checkbox" checked v-model="isBind" />
          <span class="custom-toggle-slider rounded-circle" data-label-off="否" data-label-on="是"></span>
        </label>
        <span class="h3 float-right pr-3">綁定客戶庫存品項?</span>
        <select class="form-control mt-2 mb-3" :disabled="!isBind" v-model="selectedInvId">
          <option>請選擇</option>
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
      <button class="btn btn-success mt-5 float-right" @click="onSubmit">新增</button>
    </div>

  </div>
</template>
<style scoped>
.qleditor{
    height:400px;
}
</style>
<script>
import Vue from 'vue'
import VueQuillEditor from 'vue-quill-editor'

import 'quill/dist/quill.core.css' // import styles
import 'quill/dist/quill.snow.css' // for snow theme
import 'quill/dist/quill.bubble.css' // for bubble theme

Vue.use(VueQuillEditor, /* { default global options } */)

export default {
  data: function () {
    let url = new URL(window.location.href);
    let uuid = url.pathname.split("/")[2];

    return {
      uuid: uuid,
      isBind: false,
      inventories: {},
      notes: {},
      editeNote: "",

      editorOption: {},
      selectedInvId: '',
      content: '',

    };
  },

  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill
    }
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
          console.log("inventory: something is wrong");
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
    changeEditorContent: function (id) {
      for (let i = 0; i < this.notes.length; i++) {
        this.notes[i].isActive = false;
        if (this.notes[i].id == id) {
          this.content = this.notes[i].note;
          this.notes[i].isActive = true;
        }
      }
    },
    onSubmit() {
      console.log(this.content)
      if (this.content == '') {
        return;
      }
      axios({
        method: "POST",
        url: `/api/customers/${this.uuid}/notes/`,
        data: {
          'inventory_id': this.selectedInvId,
          'note': this.content,
        },
        headers: {
            //'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        }
      }).then((res) => {
        this.$swal({
            title: "修改成功",
            icon: "success",
            timer: 900,
            showConfirmButton: false
        })
      }).catch((e) => {
        this.$swal({
            title: "修改失敗",
            icon: "error",
            text: e,
        })
      });
    },

    onEditorChange({ quill, html, text }) {
      this.content = html
      console.log(text)
    }
  },
};
</script>
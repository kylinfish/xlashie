<template>
  <div class="row">
    <div class="col-md-4 pt-5 pl-4">
      <div class="list-group" v-for="(note) in noteLogs">
        <a href="#" class="list-group-item list-group-item-action">{{note.created_at}}</a>
      </div>
    </div>

    <div class="col-md-8 pt-3 pr-4">
      <div class="form-group">

        <label class="custom-toggle custom-toggle-warning mb--3 float-right">
          <input type="checkbox" checked v-model="isBind" />
          <span class="custom-toggle-slider rounded-circle" data-label-off="否" data-label-on="是"></span>
        </label>
        <span class="h3 float-right pr-3">綁定客戶庫存品項?</span>
        <select class="form-control mt-2" :disabled="!isBind">
          <option>請選擇</option>
          <option
            v-for="(inventory) in inventories"
            v-bind:value="inventory.value"
            :value="inventory.id"
            :key="inventory.id"
          >{{ inventory.created_at}} - {{ inventory.product_name }}</option>
        </select>

        <div id="noteForm" data-toggle="quill" data-quill-placeholder="對客戶的消費狀況做紀錄吧 ..."></div>
      </div>
    </div>
  </div>
</template>
<style scoped>
#noteForm {
  height: 350px;
}
</style>
<script>
export default {
  data: function () {
    let url = new URL(window.location.href);
    let uuid = url.pathname.split("/")[2];

    return {
      uuid: uuid,
      isBind: false,
      inventories: {},
      noteLogs: [
        {
          id: 1,
          name: "2020-08-08 21:14:01 - 足部 - 指緣基礎修護 30 min",
          created_at: "2020/02/03 15:23",
          updated_at: "2020/02/03 15:23",
        },
        {
          id: 2,
          name: "2020-08-08 21:14:01 - 足部 - 指緣基礎修護 30 min",
          created_at: "2020/02/03 15:23",
          updated_at: "2020/02/03 15:23",
        },
        {
          id: 3,
          name: "2020-08-08 21:14:01 - 足部 - 指緣基礎修護 30 min",
          created_at: "2020/02/03 15:23",
          updated_at: "2020/02/03 15:23",
        },
        {
          id: 4,
          name: "2020-08-08 21:14:01 - 足部 - 指緣基礎修護 30 min",
          created_at: "2020/02/03 15:23",
          updated_at: "2020/02/03 15:23",
        },
      ],
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
          console.log(res.data);
          this.inventories = res.data.data;
        })
        .catch((res) => {
          console.log(res);
          console.log("inventory: something is wrong");
        });
    },
  },
};
</script>
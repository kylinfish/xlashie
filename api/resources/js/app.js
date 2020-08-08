require('./bootstrap');

// require vue

window.Vue = require('vue');

Vue.component('inventory-page', require('./components/customer/inventory.vue').default);
Vue.component('profile-page', require('./components/customer/profile.vue').default);
Vue.component('purchase-page', require('./components/customer/purchase.vue').default);
Vue.component('transaction-page', require('./components/customer/transaction.vue').default);
Vue.component('note-page', require('./components/customer/note.vue').default);

Date.prototype.toDatetimeLocalInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 19);
});

const app = new Vue({
    el: '#app',
});

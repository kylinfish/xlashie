require('../bootstrap');

// require vue

window.Vue = require('vue');

Vue.component('inventory-page', require('./inventory.vue').default);
Vue.component('profile-page', require('./profile.vue').default);
Vue.component('purchase-page', require('./purchase.vue').default);
Vue.component('transaction-page', require('./transaction.vue').default);
Vue.component('note-page', require('./note.vue').default);

Date.prototype.toDatetimeLocalInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 19);
});

const app = new Vue({
    el: '#app',
});

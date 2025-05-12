require('./bootstrap');
window.Vue = require('vue');

Vue.component('product-manager', require('./components/ProductManager.vue').default);

const app = new Vue({
    el: '#app',
});

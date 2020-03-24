window.Vue = require('vue');

Vue.component('error-html', require('./components/ErrorHtml.vue'));

var app = new Vue({
    el: '#app'
});
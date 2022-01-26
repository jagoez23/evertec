
require('./bootstrap');

window.Vue = require('vue').default;



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example', require('./components/ExampleComponent.vue').default);

Vue.component('user', require('./components/User.vue').default);

Vue.component('product', require('./components/Product.vue').default);






const app = new Vue({
    el: '#app',
});

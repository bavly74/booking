import Index from "./components/Index.vue";

require('./bootstrap');
import router from "./routes";
import VueRouter from "vue-router";
window.Vue = require('vue');
Vue.use(VueRouter);

// 1st way to import components

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('second-component', require('./components/SecondComponent.vue').default);
//

const app = new Vue({
    el: '#app',
    router,

    // second way to import components
    components:{
        'index': Index
    },
});

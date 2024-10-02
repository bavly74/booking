require('./bootstrap');
import Index from "./Index.vue";
import moment from "moment";
import router from "./routes";
import VueRouter from "vue-router";
import RatingStar from "./shared/components/RatingStar.vue";
import FatalError from "./shared/components/FatalError.vue";
import Success from "./shared/components/Success.vue";
import ValidationError from "./shared/components/ValidationError.vue";
import Vuex from "vuex";
window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.filter('fromNow', function (value) {
    moment(value).fromNow()
})

Vue.component('rating-star',RatingStar);
Vue.component('fatal-error',FatalError);
Vue.component('success',Success);
Vue.component('v-error',ValidationError);


// 1st way to import components => Globally
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

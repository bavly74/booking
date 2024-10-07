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
import storeDefinition from './store';

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


const store = new Vuex.Store(storeDefinition);
console.log(store)
store.commit('setLastSearch', { from: '2023-10-01', to: '2023-10-10' });

console.log(store.state.lastSearch.from)
console.log(store.state.lastSearch.to)


// 1st way to import components => Globally
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('second-component', require('./components/SecondComponent.vue').default);
//

const app = new Vue({
    el: '#app',
    store,
    router,

    // second way to import components
    components:{
        'index': Index
    },
});

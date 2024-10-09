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

window.Vue = require('vue').default; // Ensure Vue is properly loaded
Vue.use(VueRouter);  // Vue Router for Vue 2
Vue.use(Vuex);       // Vuex for Vue 2

Vue.filter('fromNow', function (value) {
    moment(value).fromNow()
});

Vue.component('rating-star', RatingStar);
Vue.component('fatal-error', FatalError);
Vue.component('success', Success);
Vue.component('v-error', ValidationError);

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        'index': Index
    },

    beforeCreate() {
        this.$store.dispatch("loadStorage");
    }

});

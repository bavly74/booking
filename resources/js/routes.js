import Bookables from "./bookables/Bookables.vue";
import VueRouter from "vue-router";
import Bookable from "./bookable/Bookable";
import Review from "./review/Review";
import Basket from "./basket/Basket.vue";
const routes=[
    {
        path: "/",
        component:Bookables,
        name: "home"
    },

    {
        path: "/bookable/:id",
        component:Bookable,
        name: "bookable"
    },

    {
        path: "/review/:id",
        component:Review,
        name: "review"
    },

    {
        path: "/basket",
        component:Basket,
        name: "basket"
    }

];

const router = new VueRouter(
    {
        mode : 'history',
        routes
    }
);
export default router;

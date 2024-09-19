import Bookables from "./bookables/Bookables.vue";
import VueRouter from "vue-router";
import Bookable from "./bookable/Bookable";

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
    }

];

const router = new VueRouter(
    {
        mode : 'history',
        routes
    }
);
export default router;

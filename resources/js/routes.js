import ExampleComponent from "./components/ExampleComponent.vue";
import SecondComponent from "./components/SecondComponent.vue";
import Bookables from "./bookables/Bookables.vue";
import VueRouter from "vue-router";

const routes=[
    {
        path: "/",
        component:Bookables,
        name: "home"
    },
    {
        path: "/second",
        component:SecondComponent,
        name: "second"
    }

];

const router = new VueRouter(
    {
        mode : 'history',
        routes
    }
);
export default router;

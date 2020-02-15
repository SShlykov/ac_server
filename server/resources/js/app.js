import Vue from "vue";

import Welcome from "./components/Welcome.vue";
import Drivers from "./components/Drivers.vue";
import Driver from "./components/pages/Driver.vue";
import Routes from "./components/Routes.vue";
import Route from "./components/pages/Route.vue";
import Tests from "./components/Tests.vue";
import Tours from "./components/Tours.vue";
import Category from "./components/pages/Сategory.vue";
import Deleted from "./components/DeletedDrivers.vue";
import EditRouts from "./components/pages/EditRouts.vue";
import ContentValue from "./components/pages/Settings.vue";
import EditCategoris from "./components/pages/EditCategoris.vue";
import Notises from "./components/pages/Notices.vue";

require("./bootstrap");

const app = new Vue({
    el: "#app",
    components: {
        drivers: Drivers,
        welcome: Welcome,
        routes: Routes,
        driver: Driver,
        route: Route,
        tests: Tests,
        tours: Tours,
        category: Category,
        deleted: Deleted,
        editrouts: EditRouts,
        contentvalue: ContentValue,
        editcategoris: EditCategoris,
        notices: Notises
    }
});

import Vue from 'vue';

import Welcome from './components/Welcome.vue';
import Drivers from './components/Drivers.vue';
import Driver from './components/pages/Driver.vue';
import Routes from './components/Routes.vue';
import Route from './components/pages/Route.vue';
import Tests from './components/Tests.vue';

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        drivers: Drivers,
        welcome: Welcome,
        routes: Routes,
        driver: Driver,
        route: Route,
        tests: Tests
    }
});

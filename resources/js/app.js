import Vue from 'vue';
import Welcome from './components/Welcome.vue';
import Drivers from './components/Drivers.vue';
import Routes from './components/Routes.vue';
require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        drivers: Drivers,
        welcome: Welcome,
        routes: Routes
    }
});

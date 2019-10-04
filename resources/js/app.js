import Vue from 'vue';
import Wellcome from './components/Wellcome.vue';
require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        wellcome: Wellcome
    }
});

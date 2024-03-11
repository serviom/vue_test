import Vue from 'vue';

import Vuetify from '../plugins/vuetify';
import axios from "axios";
import { VueMaskDirective } from 'v-mask'

Vue.component('welcome-component', require('./components/WelcomeComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('custom-prefix', require('./components/CustomPrefix.vue').default);
Vue.directive('mask', VueMaskDirective);


const axiosInstance = axios.create({
});

Vue.prototype.$axios = axiosInstance;

new Vue({
    vuetify: Vuetify,
    el: '#app'
})

require('./bootstrap');

import Vue from 'vue';
import ProductList from './components/ProductList.vue';
import ComponentList from './components/ComponentList.vue';

new Vue({
    el: '#app',

    components: { ProductList, ComponentList }
})

Vue.config.devtools = true;
Vue.config.performance = true;

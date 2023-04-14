/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import { createApp } from 'vue';

import Root from './components/Root.vue';
import Router from './router'
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

const app = createApp(Root)
app.use(Router)
app.component('EasyDataTable', Vue3EasyDataTable);
app.mount('#app');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
const { Vuelidate } = require('vuelidate')

import vSelect from 'vue-select'

/**
 * Select for forms
 */
Vue.component('v-select', vSelect)

/**
 * Validation for forms
 */
Vue.use(Vuelidate)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-list', require('./components/AdminList.vue').default);
Vue.component('course-list', require('./components/CourseList.vue').default);
Vue.component('table-list', require('./components/TableList.vue').default);
Vue.component('my-course-list', require('./components/MyCoursesList.vue').default);
Vue.component('my-class-list', require('./components/MyClassList.vue').default);
Vue.component('course-form', require('./components/CourseForm.vue').default);
Vue.component('register-form', require('./components/RegisterForm.vue').default);
Vue.component('table-form', require('./components/TableForm.vue').default);

Vue.component('class-list', require('./components/User/ClassList.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

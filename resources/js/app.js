/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
const { Vuelidate } = require('vuelidate')
import VueSweetalert2 from 'vue-sweetalert2';

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
 * Validation for forms
 */
Vue.use(VueSweetalert2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('admin-list', require('./components/list/AdminList.vue').default);
Vue.component('course-list', require('./components/list/CourseList.vue').default);
Vue.component('table-list', require('./components/list/TableList.vue').default);
Vue.component('my-course-list', require('./components/list/MyCoursesList.vue').default);
Vue.component('my-class-list', require('./components/list/MyClassList.vue').default);
Vue.component('course-form', require('./components/form/CourseForm.vue').default);
Vue.component('register-form', require('./components/form/RegisterForm.vue').default);
Vue.component('table-form', require('./components/form/TableForm.vue').default);
Vue.component('material-form', require('./components/form/MaterialForm.vue').default);
Vue.component('teacher-profile-form', require('./components/Teacher/TeacherProfileForm.vue').default);

Vue.component('content-list', require('./components/list/ContentList.vue').default);
Vue.component('activity-list', require('./components/list/ActivityList.vue').default);
Vue.component('class-list', require('./components/User/ClassList.vue').default);
Vue.component('profile-form', require('./components/User/ProfileForm.vue').default);
Vue.component('teacher-class-list', require('./components/Teacher/TeacherClassList.vue').default);
Vue.component('detail', require('./components/Detail.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

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
import VuePlyr from 'vue-plyr'
import Vuex from 'vuex'
import store from "./components/state";
import VueEllipseProgress from 'vue-ellipse-progress';
import VCalendar from 'v-calendar';
import moment from 'vue-moment'
import ToggleButton from 'vue-js-toggle-button'

// import Lingallery from 'lingallery';


/**
 * Handy Moment.js filters for your Vue.js project.
 */
Vue.use(moment)

/**
 * Lingallery
 */
// Vue.component('lingallery', Lingallery);

Vue.use(VuePlyr)

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
 * Plugin to create beautiful and animated circular progress bars
 */
Vue.use(VueEllipseProgress);

/**
 * An elegant calendar and datepicker plugin for Vuejs.
 */
Vue.use(VCalendar);

/**
 * An elegant toggle for Vuejs.
 */
Vue.use(ToggleButton)

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
Vue.component('program-list', require('./components/list/ProgramList.vue').default);
Vue.component('subject-list', require('./components/list/SubjectList.vue').default);
Vue.component('group-list', require('./components/list/GroupList.vue').default);
Vue.component('my-group-list', require('./components/list/MyGroupList.vue').default);
Vue.component('my-course-list', require('./components/list/MyCoursesList.vue').default);
Vue.component('my-class-list', require('./components/list/MyClassList.vue').default);
Vue.component('my-student-list', require('./components/list/MyStudentList.vue').default);
Vue.component('content-list', require('./components/list/ContentList.vue').default);
Vue.component('activity-list', require('./components/list/ActivityList.vue').default);
Vue.component('class-list', require('./components/User/ClassList.vue').default);
Vue.component('teacher-class-list', require('./components/teacher/TeacherClassList.vue').default);
Vue.component('student-list', require('./components/teacher/StudentList.vue').default);
Vue.component('homework-list', require('./components/teacher/HomeworkList.vue').default);
Vue.component('grade-exam', require('./components/teacher/GradeExam.vue').default);
Vue.component('score-exam', require('./components/teacher/ScoreExam.vue').default);
Vue.component('grade-question', require('./components/teacher/GradeQuestion.vue').default);
Vue.component('choice-claim', require('./components/teacher/ChoiceClaim.vue').default);
Vue.component('result-user', require('./components/teacher/ResultUser.vue').default);
Vue.component('open-claim', require('./components/teacher/OpenClaim.vue').default);
Vue.component('exam-list', require('./components/list/ExamList.vue').default);
Vue.component('my-exam-list', require('./components/User/MyExamList.vue').default);
Vue.component('module-list', require('./components/list/ModuleList.vue').default);
Vue.component('answer-list', require('./components/list/AnswerList.vue').default);
Vue.component('payment-list', require('./components/list/PaymentList.vue').default);
Vue.component('bills-list', require('./components/list/BillsList.vue').default);
Vue.component('concept-list', require('./components/list/ConceptList.vue').default);

Vue.component('course-form', require('./components/form/CourseForm.vue').default);
Vue.component('register-form', require('./components/form/RegisterForm.vue').default);
Vue.component('table-form', require('./components/form/TableForm.vue').default);
Vue.component('level-form', require('./components/form/LevelForm.vue').default);
Vue.component('material-form', require('./components/form/MaterialForm.vue').default);
Vue.component('teacher-profile-form', require('./components/teacher/TeacherProfileForm.vue').default);
Vue.component('admin-profile-form', require('./components/admin/AdminProfileForm').default);
Vue.component('exam-form', require('./components/form/ExamForm.vue').default);
Vue.component('question-form', require('./components/form/QuestionForm.vue').default);
Vue.component('module-form', require('./components/form/ModuleForm.vue').default);
Vue.component('profile-form', require('./components/User/ProfileForm.vue').default);
Vue.component('answer-form', require('./components/form/AnswerForm.vue').default);
Vue.component('payment-form', require('./components/form/PaymentForm.vue').default);
Vue.component('program-form', require('./components/form/ProgramForm.vue').default);
Vue.component('cycle-form', require('./components/form/CycleForm.vue').default);
Vue.component('subject-form', require('./components/form/SubjectForm.vue').default);
Vue.component('group-form', require('./components/form/GroupForm.vue').default);
Vue.component('bill-form', require('./components/form/BillForm.vue').default);
Vue.component('concept-form', require('./components/form/ConceptForm.vue').default);
Vue.component('reports-form', require('./components/form/ReportsForm.vue').default);

Vue.component('course-add', require('./components/form/CourseAdd.vue').default);
Vue.component('group-add', require('./components/form/GroupAdd.vue').default);
Vue.component('user-add', require('./components/form/UserAdd.vue').default);
Vue.component('concept-add', require('./components/form/ConceptAdd.vue').default);
Vue.component('custom-concept-add', require('./components/form/CustomConceptAdd.vue').default);
Vue.component('exam-add', require('./components/layouts/ExamAdd.vue').default);
Vue.component('user-courses', require('./components/layouts/UserCourses.vue').default);
Vue.component('group-users', require('./components/layouts/GroupUsers.vue').default);
Vue.component('user-groups', require('./components/layouts/UserGroups.vue').default);

Vue.component('loader', require('./components/layouts/Loader.vue').default);

Vue.component('score-material', require('./components/form/ScoreMaterial.vue').default);
Vue.component('detail', require('./components/Detail.vue').default);
Vue.component('start-exam', require('./components/User/StartExam.vue').default);
Vue.component('question', require('./components/User/Question.vue').default);
Vue.component('open-answer', require('./components/User/OpenAnswer.vue').default);
Vue.component('answer', require('./components/User/Answer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});

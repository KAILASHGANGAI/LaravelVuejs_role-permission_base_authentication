import { createRouter, createWebHistory } from "vue-router";
import adminHome from '../components/admin/index.vue';
import adminlogin from '../components/admin/auth/login.vue';
import userlist from '../components/admin/users/userlist.vue';


import Students from '../components/admin/main/students/show.vue'
import addStudent from '../components/admin/main/students/add_student.vue'
import add_guardian from '../components/admin/main/students/add_guardian.vue'
import edit_guardian from '../components/admin/main/students/edit_guardian.vue'
import editStudent from '../components/admin/main/students/edit_student.vue'
import studentId from '../components/admin/main/students/idcard.vue'

import add_staffs from '../components/admin/main/staffs/add_staffs.vue'
import show_staffs from '../components/admin/main/staffs/show_staffs.vue'
import edit_staff from '../components/admin/main/staffs/edit_staff.vue'
import staff_category from '../components/admin/main/staffs/staff_category.vue'

import add_periods from '../components/admin/main/periods/add_periods.vue'
import show_periods from '../components/admin/main/periods/show_periods.vue'
import single_period from '../components/admin/main/periods/single.vue'


import add_attendance from '../components/admin/main/attendance/add_attendance.vue'
import show_attendance from '../components/admin/main/attendance/show_attendance.vue'
import single_att from '../components/admin/main/attendance/single_attendance.vue'
import detail_att from '../components/admin/main/attendance/detail.vue'


import account from '../components/admin/main/account/account.vue'
import payment from '../components/admin/main/account/payment.vue'
import payment_records from '../components/admin/main/account/payment_records.vue'
import paymentBill from '../components/admin/main/account/payment_bill.vue'
import expenditure from '../components/admin/main/account/expenditure.vue'
import storeexpenditure from '../components/admin/main/account/create_exp.vue'
import editexpenditure from '../components/admin/main/account/edit_exp.vue'

import add_books from '../components/admin/main/libreary/add_books.vue'
import edit_book from '../components/admin/main/libreary/edit.vue'
import show_books from '../components/admin/main/libreary/show_books.vue'
import take_books from '../components/admin/main/libreary/take_books.vue'
import return_books from '../components/admin/main/libreary/return_books.vue'

import add_notes from "../components/admin/main/notes/create.vue";
import show_notes from "../components/admin/main/notes/show.vue";
import edit_notes from "../components/admin/main/notes/edit.vue";

import add_assignment from "../components/admin/main/assignment/create.vue";
import show_assignment from "../components/admin/main/assignment/show.vue";
import edit_assignment from "../components/admin/main/assignment/edit.vue";
import view_assignment from "../components/admin/main/assignment/view.vue";

import add_exam from "../components/admin/main/exam/create.vue";
import show_exam from "../components/admin/main/exam/show.vue";
import edit_exam from "../components/admin/main/exam/edit.vue";
import single_exam from "../components/admin/main/exam/single.vue";
import routing from "../components/admin/main/exam/routing.vue";
// import login_to_admin from "../components/admin//login.vue";

// import admin_logout from "../components/admin//logout.vue";

// import student_admin from "../components/admin/main/student_admin/home.vue";
import admin_slider from "../components/admin/main/Front/slider/show.vue";
import Add_slider from "../components/admin/main/Front/slider/add.vue";
import Edit_slider from "../components/admin/main/Front/slider/edit.vue";

import admin_testimonials from "../components/admin/main/Front/testimonials/show.vue";
import Add_testimonials from "../components/admin/main/Front/testimonials/add.vue";
import Edit_testimonials from "../components/admin/main/Front/testimonials/edit.vue";

import admin_about from "../components/admin/main/Front/about/show.vue";
import Add_about from "../components/admin/main/Front/about/add.vue";
import Edit_about from "../components/admin/main/Front/about/edit.vue";

import admin_events from "../components/admin/main/Front/events/show.vue";
import Add_events from "../components/admin/main/Front/events/add.vue";
import Edit_events from "../components/admin/main/Front/events/edit.vue";

import admin_notices from "../components/admin/main/Front/notices/show.vue";
import Add_notices from "../components/admin/main/Front/notices/add.vue";
import Edit_notices from "../components/admin/main/Front/notices/edit.vue";

import admin_facultymembers from "../components/admin/main/Front/faculty_members/show.vue";
import Add_facultymembers from "../components/admin/main/Front/faculty_members/add.vue";
import Edit_facultymembers from "../components/admin/main/Front/faculty_members/edit.vue";

import gallery from "../components/admin/main/Front/gallery/show.vue";
import add_gallery from "../components/admin/main/Front/gallery/add.vue";

import admin_news from "../components/admin/main/Front/news/show.vue";
import Add_news from "../components/admin/main/Front/news/add.vue";
import Edit_news from "../components/admin/main/Front/news/edit.vue";

import settings from "../components/admin/main/settings/settings.vue";
import general_settings from "../components/admin/main/settings/general.vue";
import subjects from "../components/admin/main/settings/subjects.vue";
import add_subjects from "../components/admin/main/settings/add_subject.vue";

import add_marksheet from "../components/admin/main/marksheet/add.vue";
import show_marksheet from "../components/admin/main/marksheet/show.vue";
import laser_marksheet from "../components/admin/main/marksheet/laser.vue";
import marksheet from "../components/admin/main/marksheet/marksheets.vue";

// teachers section 
import Tea_add_notes from "../components/TeacherAdmin/notes/create.vue";
import Tea_show_notes from "../components/TeacherAdmin/notes/show.vue";
import Tea_edit_notes from "../components/TeacherAdmin/notes/edit.vue";

import Tea_add_assignment from "../components/TeacherAdmin/assignment/create.vue";
import Tea_show_assignment from "../components/TeacherAdmin/assignment/show.vue";
import Tea_edit_assignment from "../components/TeacherAdmin/assignment/edit.vue";
import Tea_view_assignment from "../components/TeacherAdmin/assignment/view.vue";

import Tea_add_marksheet from "../components/TeacherAdmin/marksheet/add.vue";
import Tea_show_marksheet from "../components/TeacherAdmin/marksheet/show.vue";
import Tea_laser_marksheet from "../components/TeacherAdmin/marksheet/laser.vue";
import Tea_marksheet from "../components/TeacherAdmin/marksheet/marksheets.vue";
import Tea_routing from "../components/TeacherAdmin/marksheet/routing.vue";


const routes = [
    {
        path: "/admin",
        name: "adminHome",
        component: adminHome,
        meta: {
            requiresAuth: true,
        },
       
    },
    {
        path: "/admin/login",
        name: "adminlogin",
        component: adminlogin,
        meta: {
            requiresAuth: false,
        },
       
    },
    {
        path: "/admin/users",
        name: "userlist",
        component: userlist,
        meta: {
            requiresAuth: true,
        },
       
    },
    // { path: '/admin/login', component: login_to_admin },
    // { path: '/admin/logout', component: admin_logout },
    // { path: '/admin', component: dashboard },
    // { path: '/admin/dashboard', component: dashboard },
    { path: '/admin/students', component: Students },
    { path: '/admin/add_student', component: addStudent },
    { path: '/admin/students/edit/:id', component: editStudent, props: true },
    { path: '/admin/student-idcard', component: studentId },
    { path: '/admin/guardian/edit/:id', component: edit_guardian, props: true },

    { path: '/admin/add_guardian', component: add_guardian },
    { path: '/admin/staff-category', component: staff_category },
    { path: '/admin/staff-details', component: show_staffs },
    { path: '/admin/add-staff-members', component: add_staffs },
    { path: '/admin/staffs/edit/:id', component: edit_staff, props: true },

    { path: '/admin/add-period', component: add_periods },
    { path: '/admin/period-details', component: show_periods },
    { path: '/admin/periods/single/:id', component: single_period, props: true },

    { path: '/admin/add-attendance', component: add_attendance },
    { path: '/admin/attendance-details', component: show_attendance },
    {
        path: '/admin/single-attendance/:id',
        component: single_att,
        props: true
    },
    {
        path: '/admin/detail-attendance/:id',
        component: detail_att,
        props: true
    },
    { path: '/admin/account-details', component: account },
    { path: '/admin/payment', component: payment },
    { path: '/admin/payment-records', component: payment_records },
    {
        path: '/admin/payment-bill-print/:id',
        component: paymentBill,
        props: true
    },

    { path: '/admin/expenditure', component: expenditure },
    { path: '/admin/store-expenditure', component: storeexpenditure },
    { path: '/admin/edit-expenditure/:id', component: editexpenditure, props: true },

    { path: '/admin/add-books', component: add_books },
    {
        path: '/admin/libreary/edit/:id',
        component: edit_book,
        props: true
    },
    { path: '/admin/show-books', component: show_books },
    { path: '/admin/return-books', component: return_books },
    { path: '/admin/take-books', component: take_books },

    { path: '/admin/show-notes', component: show_notes },
    { path: '/admin/add-notes', component: add_notes },
    { path: '/admin/edit-notes/:id', component: edit_notes, props: true },

    { path: '/admin/show-assignment', component: show_assignment },
    { path: '/admin/add-assignment', component: add_assignment },
    { path: '/admin/edit-assignment/:id', component: edit_assignment, props: true },
    { path: '/admin/view-assignment/:id', component: view_assignment, props: true },

    { path: '/admin/exam-show', component: show_exam },
    { path: '/admin/add-exam', component: add_exam },
    { path: '/admin/exam-routing', component: routing },
    { path: '/admin/edit-exam/:id', component: edit_exam, props: true },
    { path: '/admin/single-exam/:id', component: single_exam, props: true },
    // student admin

    // { path: '/admin/student/admin/:id/:usertype', component: student_admin, props: true }
    { path: '/admin/slider', component: admin_slider },
    { path: '/admin/add-slider', component: Add_slider },
    { path: '/admin/edit-slider/:id', component:Edit_slider , props:true},

    { path: '/admin/testimonials', component: admin_testimonials },
    { path: '/admin/add-testimonials', component: Add_testimonials },
    { path: '/admin/edit-testimonials/:id', component:Edit_testimonials , props:true},

    { path: '/admin/about', component: admin_about },
    { path: '/admin/add-about', component: Add_about },
    { path: '/admin/edit-about/:id', component:Edit_about , props:true},

    { path: '/admin/events', component: admin_events },
    { path: '/admin/add-events', component: Add_events },
    { path: '/admin/edit-events/:id', component:Edit_events , props:true},

    { path: '/admin/notices', component: admin_notices },
    { path: '/admin/add-notices', component: Add_notices },
    { path: '/admin/edit-notices/:id', component:Edit_notices , props:true},

    { path: '/admin/faculty-members', component: admin_facultymembers },
    { path: '/admin/add-faculty-members', component: Add_facultymembers },
    { path: '/admin/edit-faculty-members/:id', component:Edit_facultymembers , props:true},

    
    { path: '/admin/gallery', component: gallery },
    { path: '/admin/add-gallery', component: add_gallery },

    { path: '/admin/news', component: admin_news },
    { path: '/admin/add-news', component: Add_news },
    { path: '/admin/edit-news/:id', component:Edit_news , props:true},

    { path: '/admin/settings', component: settings },
    { path: '/admin/general-settings', component: general_settings },
    { path: '/admin/subjects', component: subjects },
    { path: '/admin/add-subjects', component: add_subjects },

    { path: '/admin/marksheet-show', component: show_marksheet },
    { path: '/admin/add-marksheet/:id', component: add_marksheet, props:true },
    { path: '/admin/marksheet-laser/:id', component: laser_marksheet, props:true },
    { path: '/admin/marksheet/:id', component: marksheet, props:true },
//end of admin section
// teachers section
    { path: '/teacher/show-notes', component: Tea_show_notes },
    { path: '/teacher/add-notes', component: Tea_add_notes },
    { path: '/teacher/edit-notes/:id', component: Tea_edit_notes, props: true },

    { path: '/teacher/show-assignment', component: Tea_show_assignment },
    { path: '/teacher/add-assignment', component: Tea_add_assignment },
    { path: '/teacher/edit-assignment/:id', component: Tea_edit_assignment, props: true },
    { path: '/teacher/view-assignment/:id', component: Tea_view_assignment, props: true },

    { path: '/teacher/marksheet-show', component: Tea_show_marksheet },
    { path: '/teacher/add-marksheet/:id', component: Tea_add_marksheet, props:true },
    { path: '/teacher/marksheet-laser/:id', component: Tea_laser_marksheet, props:true },
    { path: '/teacher/marksheet/:id', component: Tea_marksheet, props:true },
    { path: '/teacher/exam-routing', component: Tea_routing },

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from)=>{
    if (to.meta.requiresAuth  && !localStorage.getItem('admintoken')) {
        return {name:adminlogin}
    } 
     if(to.meta.requiresAuth == false &&  localStorage.getItem('admintoken')) {
        return {name:adminHome}
    }
    
   
})
export default router;

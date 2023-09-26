import { createRouter, createWebHistory } from "vue-router";
import adminHome from '../components/admin/index.vue';
import adminlogin from '../components/admin/auth/login.vue';
import userlist from '../components/admin/users/userlist.vue';

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

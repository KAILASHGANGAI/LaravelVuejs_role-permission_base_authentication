import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/index.vue";
import login from "../components/auth/login.vue";
import logout from "../components/auth/logout.vue";
import register from "../components/auth/register.vue";
// import post from "../components/post/post.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
       
    },
    {
        path: "/login",
        name: login,
        component: login,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/register",
        name: register,
        component: register,
        meta: {
            requiresAuth: false,
        },
    },
    {
        path: "/logout",
        name: "logout",
        component: logout,
        meta: {
            requiresAuth: true,
        },
    },
    // {
    //     path: "/post",
    //     name: "post",
    //     component: post,
    //     meta: {
    //         requiresAuth: true,
    //     },
    //},

];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from)=>{
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return {name:login}
    } 
     if(to.meta.requiresAuth == false &&  localStorage.getItem('token')) {
        return {name:post}
    }
    
   
})
export default router;

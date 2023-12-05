<template>
    
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter" v-if="notifications.length > 0">{{ notifications.length }}</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Alerts Center  <span class="text-warning small float-end" style="cursor: pointer;" @click="allread()">Mark as all Read</span>
            </h6>
            <a class="dropdown-item align-items-center" v-for="(notification,index ) in notifications" :key="index" href="#">
                <div class="d-flex">
                    <div class="mr-3" >
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div @click="markAsRead(notification.id)">
                    <div class="small text-gray-500"><span class="text-success ">{{notification.data.user_name  }}</span> {{ notification.data.date.split("T")[0] }}</div>
                    <span class="font-weight-bold">{{ notification.data.title }}</span>
                </div>
                </div>
                <div >
                    <p>{{ notification.data.description }}</p>
                </div>
            </a>
           
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
    </li>
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow" v-if="adminuser != 0">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ adminuser }}</span>
            <img class="img-profile rounded-circle"
                src="../../../../../public/img/undraw_profile_1.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"  data-toggle="modal" @click="logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
</template>
<script>
import axios from 'axios'
import router from '../../../adminrouter'
import store from '../../../adminstore'
export default{
    data(){
        return{
            adminuser:'',
            notifications:[],
        }
    },
    created(){
        this.adminuser = store.getters.getAdminUser
        axios.get('/api/notifications', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                
                this.notifications = res.data.data;
                this.broadcast(res.data.id)
                // console.log(res)
            })
            
            
       
    },
    mounted(){
       
    },
    methods:{
        allread(){
            axios.get('/api/notification-allread' , {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
               console.log(res)
            })
        },
        markAsRead(e){
            axios.get('/api/notification-read/' + e , {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
               console.log(res)
            })
        },
        broadcast(index){
            Echo.private('testing.'+index)
            .notification((e) => {
	            this.notifications.push(e.noticication);
                console.log(e);
            })
        },
        logout() {
            axios.get('/api/logout').then((res) => {
                store.dispatch('removeAdminToken')
                store.dispatch('removeAdminUser')
                router.push('/admin/login')
                // console.log(res)
            })
        }
    }
}

</script>
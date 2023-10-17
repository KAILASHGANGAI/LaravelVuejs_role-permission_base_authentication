<template>
 <!-- Page Wrapper -->
 <div id="wrapper">
<!-- Sidebar -->
<sidebar    v-if="$route.path !== '/admin/login' && is('admin')" ></sidebar>
<TeacherSidebar v-if="$route.path !== '/admin/login' && is('writer')"></TeacherSidebar>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <headervue   v-if="$route.path !== '/admin/login'"></headervue>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
           

            <router-view></router-view>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footervue  v-if="$route.path !== '/admin/login'"></footervue>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
</template>
<script>
import TeacherSidebar from './admin/parts/teacher_side.vue';
import Footer from './admin/parts/footer.vue';
import headervue from './admin/parts/header.vue';
import Sidebar from './admin/parts/sidebar.vue';
import store from '../adminstore';
import router from '../adminrouter';
export default{
    components:{
        'headervue': headervue,
        'sidebar': Sidebar,
        'footervue':Footer,
        'TeacherSidebar':TeacherSidebar
    },
data(){
    return{
        getAdminToken : store.getters.getAdminToken
    }
},
created(){
    if (this.getAdminToken == 0) {
        router.push('/admin/login')
    }
},
mounted() {
    setTimeout(() => {
      localStorage.removeItem('admintoken');
      localStorage.removeItem('adminusername');
    }, 150 * 60 * 1000); // 20 minutes in milliseconds
  },
}
</script>

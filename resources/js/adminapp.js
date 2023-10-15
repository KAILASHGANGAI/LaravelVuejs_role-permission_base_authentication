
import './bootstrap';
import '../css/app.css';

import {createApp} from 'vue'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'
window.Swal = Swal;
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showComfirmButton: false,
    timer: 5000,
    timeProgressBar: true,
});
window.toast = toast;

import adminrouter from './adminrouter'
import AdminApp from './components/adminapp.vue'
import adminstore from './adminstore';
import laravelPermissionToVuejs from 'laravel-permission-to-vuejs'
import DataTablesLib from 'datatables.net'; 
import DataTable from 'datatables.net-vue3';
 
DataTable.use(DataTablesLib);
createApp(AdminApp)
            .use(adminrouter)
            .use(adminstore)
            .use(laravelPermissionToVuejs)
            .component('DataTable', DataTable) 

            .mount("#adminapp")
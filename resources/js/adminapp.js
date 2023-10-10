
import './bootstrap';
import {createApp} from 'vue'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
DataTable.use(DataTablesCore);
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

createApp(AdminApp)
            .use(adminrouter)
            .use(adminstore)
            .use(laravelPermissionToVuejs)
            .mount("#adminapp")

import './bootstrap';
import {createApp} from 'vue'

import adminrouter from './adminrouter'
import AdminApp from './components/adminapp.vue'
import adminstore from './adminstore';
import laravelPermissionToVuejs from 'laravel-permission-to-vuejs'

createApp(AdminApp)
            .use(adminrouter)
            .use(adminstore)
            .use(laravelPermissionToVuejs)
            .mount("#adminapp")
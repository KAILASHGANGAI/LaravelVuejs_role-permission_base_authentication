
import './bootstrap';
import {createApp} from 'vue'

import router from './router'
import  Store from './store';

import App from './components/app.vue'
import store from './store';


createApp(App)
            .use(router)
            .use(store)
            .mount("#app")
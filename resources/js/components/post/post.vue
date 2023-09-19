<template>
<navbarvue></navbarvue>
<h1>Post</h1> <button @click="logout">Logout</button>
<footervue></footervue>

</template>
<script>
import navbar from '../parts/navbar.vue';
import footer from '../parts/footer.vue';
import { useStore } from 'vuex';
import store from '../../store';
export default{
    setup(){
        const store = useStore();
    },
    components:{
        'navbarvue':navbar,
        'footervue':footer,
    },
    methods:{
        logout(){
            axios.get('/api/logout').then((res)=>{
             store.dispatch('removeToken')
            console.log(res)
       })
        }
    }
}
</script>
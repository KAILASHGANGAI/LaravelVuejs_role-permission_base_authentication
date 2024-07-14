<template>

</template>
<script>
import router from '../../router'
import {useStore} from 'vuex'
import store from '../../store'

export default{
    setup(){
        const storage = useStore()
    },
    created() {
        this.logout()
        
    },

    methods: {
        logout() {
            axios.get('/api/logout').then((res) => {
                store.dispatch('removeToken')
                store.dispatch('removeUser')
               window.location = "/admin/login"
                console.log(res)
            })
        }
    }
}

</script>
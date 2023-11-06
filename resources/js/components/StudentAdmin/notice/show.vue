<template>
    <div class="container  pb-5">
        <h4 class="card-title">Notices</h4>
        <div class="container">
            <div class="container">
                        <div class="row">
                            <div class="col-sm-6" v-for="(data, index) in datas" :key="index">
                                <div class="bg-info p-4 text-white">
                                    <h5 class="text-center">{{ data.heading }}</h5>
                                    <p class="text-center">
                                        {{ data.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</template>
    
<script>
import axios from 'axios';
import router from '../../../adminrouter';
import store from '../../../adminstore';

export default {
    data() {
        return {
            datas: [],
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/student/notices', {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res)
            this.datas = res.data
        }).catch((error) => {
            router.push('/admin/login');
            localStorage.clear()
            toast.fire({
                icon: "error",
                title: error.response.data.message
            })
        })
    },
    methods: {
        
        
    }
}
</script>
    
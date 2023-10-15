<template>
    <div class="container card pb-5">
        <h1 class="card-title">create gallery</h1>
        <router-link class="btn btn-success" to="/add-gallery">Add gallery</router-link>
        <div class="container">
            <table class="row">

                <div class="col-md-2 m-2" v-for="(data, index) in datas" :key="index">
                    <img :src="'../' + data.images" alt="" class="img-fluid">
                    <button class="btn btn-info w-100" @click="deleteImg(data.id)">Delete</button>
                </div>

            </table>
        </div>
    </div>
</template>
    
<script>
import axios from 'axios';
import router from '../../../../../adminrouter';
import store from '../../../../../adminstore';

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
        axios.get('/api/gallery', {
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
        deleteImg(index) {
            axios.delete('/api/gallery/' + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                toast.fire({
                    icon: "succcess",
                    title: res.data.status
                })
                this.datas = this.datas.filter(data => {
                    return data.id != index
                })

            })
        }
    }
}
</script>
    
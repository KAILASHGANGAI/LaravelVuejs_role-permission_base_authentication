<template>
    <div class="container card pb-5">
        <h1 class="card-title">create events</h1>
        <router-link class="btn btn-success" to="/admin/add-events">Add events</router-link>
        <div class="container w-full">
            <table class="table mt-2">
                <tr>
                    <th>S.N</th>
                    <th>Heading</th>
                    <th>Desctiption</th>
                    <th>Image</th>
                    <th>Event_date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(data, index) in datas" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ data.heading }}</td>

                    <td>{{ data.description }}</td>
                    <td><img :src="'../' + data.image" alt="" width="50"></td>
                    <td>
                        <span v-if="data.status === 1" @click="publish(data.id)" class="text-success">published</span>
                        <span v-else class="text-danger" @click="publish(data.id)">Not Published</span>
                    </td>
                    <td>{{ data.event_date }}</td>
                    <td>
                        <span class="  btn btn-success" @click="Edit(data.id)">
                           Edit
                        </span>
                        <span class=" btn btn-danger" @click="Delete(data.id)">
                            Delete
                        </span>
                    </td>
                </tr>

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
        this.getdata()
    },
    methods: {
        getdata() {
            axios.get('/api/events', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                // console.log(res)
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
        publish(id) {
            axios.get('/api/publish-events/' + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                this.getdata()

                toast.fire({
                    icon: "succcess",
                    title: res.data.status
                })
            })
        },
        Edit(index) {
            router.push('/admin/edit-events/' + index)
        },
        Delete(index) {
            axios.delete('/api/events/' + index, {
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
    
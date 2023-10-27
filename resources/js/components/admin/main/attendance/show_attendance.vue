<template>
    <div class="container card">
        <h1 class="card-title">attendance show</h1>
        <table class="table">
            <thead class="bg-success text-white">
                <th>S.n</th>
                <th>Teacher_Name</th>
                <th>Faculty</th>
                <th>Semester</th>
                <th>Section</th>
                <th>Date</th>
                <th>Action</th>
            </thead>
            <tbody>
              
                <tr v-for="(data, index) in datas" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ data.user.name}}</td>
                    <td>{{ data.faculty.faculty_name }}</td>
                    <td>{{ data.semester.semester_years }}</td>
                    <td>{{ data.section.section_name }}</td>
                    <td>{{ data.created_at }}</td>
                    <td class="">
                        <button class="btn-success" v-if="data.status == 1" @click="viewDetail(data.id)">View details</button>
                        <button class="btn-warning" v-if="data.status == 0" @click="view(data.id)">view </button>
                        <button class="btn-danger" @click="deleteAtt(data.id)">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            datas: [],
        };
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get("/api/create-attendance", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            this.datas = res.data;
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
        view(index) {
            router.push("/admin/single-attendance/" + index);
        },
        viewDetail(index) {
            router.push("/admin/detail-attendance/" + index);
        },
        deleteAtt(index) {
            axios.delete('/api/create-attendance/' + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {

                this.datas = this.datas.filter(data => {
                    return data.id != index
                })
            })
        }
    }
};
</script>

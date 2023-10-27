<template>
    <div class="container card">
        <h1 class="card-title">Marksheet Management System </h1>

        <div class="responsive">
            <table class="table border">
                <thead class="bg-success text-white">
                    <th>S.N</th>
                    <th>Faculty</th>
                    <th>Semester/Yrs</th>
                    <th>Section</th>
                    <th>Exam Type</th>

                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{+ + index }}</td>
                        <td>{{ data.faculty.faculty_name }}</td>
                        <td>{{ data.semester.semester_years }}</td>
                        <td>{{ data.section.section_name }}</td>
                        <td>{{ data.exam_type }}</td>

                        <td class="">
                            <span class=" btn btn-warning" @click="ShowMarks(data.id)">
                               View
                            </span>
                            <span class="btn btn-info" @click="addMarks(data.id)">
                               Add +
                            </span>
                            <span class="btn btn-success" @click="markslaser(data.id)">
                              laser
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
    
<script>
import router from '../../../adminrouter';
import store from '../../../adminstore';

export default {
    data() {
        return {
            datas: []
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/teacher/exams/list', {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
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
        addMarks(index) {
            router.push('/teacher/add-marksheet/' + index)
        },
        markslaser(index) {
            router.push('/teacher/marksheet-laser/' + index)
        },
        ShowMarks(index) {
            router.push('/teacher/marksheet/' + index)

        }
    }
}
</script>
<style scoped>
span {
    padding: 6px;

}

span:hover {
    cursor: pointer;
}
</style>
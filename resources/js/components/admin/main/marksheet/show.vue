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

                        <td class="float-end">
                            <span class=" text-warning" @click="ShowMarks(data.id)">
                                <i class="ri-eye-fill"></i>
                            </span>
                            <span class="text-info" @click="addMarks(data.id)">
                                <i class="ri-edit-box-fill"></i>
                            </span>
                            <span class="text-success" @click="markslaser(data.id)">
                                <i class="ri-edit-box-fill"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
    
<script>
import router from '../../../../adminrouter';

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
        axios.get('/api/exams', {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
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
            router.push('/admin/add-marksheet/' + index)
        },
        markslaser(index) {
            router.push('/admin/marksheet-laser/' + index)
        },
        ShowMarks(index) {
            router.push('/admin/marksheet/' + index)

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
<template>
    <div class="container card">
        <h1 class="card-title">Exams Lists</h1>

        <div class="responsive">
            <table class="table border">
                <thead class="bg-success text-white">
                    <th>S.N</th>
                    <th>Faculty</th>
                    <th>Semester/Yrs</th>
                    <th>Section</th>
                    <th>Exam Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{+ + index }}</td>
                        <td>{{ data.faculty.faculty_name }}</td>
                        <td>{{ data.semester.semester_years }}</td>
                        <td>{{ data.section.section_name }}</td>
                        <td>{{ data.exam_type }}</td>
                        <td>{{ data.date }}</td>
                        <td>{{ data.time }}</td>
                        <td class="float-end">
                            <span class=" text-warning" @click="View(data.id)">
                                <i class="ri-eye-fill"></i>
                            </span>
                            <span class="  text-success" @click="Edit(data.id)">
                                <i class="ri-edit-box-fill"></i>
                            </span>
                            <span class=" text-danger" @click="Delete(data.id)">
                                <i class="ri-delete-bin-2-fill"></i>
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
        View(index) {
            router.push('/admin/single-exam/' + index)
        },
        Edit(index) {
            router.push('/admin/edit-exam/' + index)
        },
        Delete(index) {
            axios.delete('/api/exams/' + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                console.log(res.status);
                this.datas = this.datas.filter(data => {
                    return data.id != index
                })
            })
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
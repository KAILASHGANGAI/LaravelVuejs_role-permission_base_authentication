<template>
    <div class="card p-3">
        <h2 class="card-title">Detail of Attendance</h2>
        <div class="container">
            <div class="d-flex justify-content-around">
                <span>Faculty: {{ datas.faculty.faculty_name }}</span>
                <span>Semester: {{ datas.semester.semester_years }}</span>
                <span>Section: {{ datas.section.section_name }}</span>
                <span>Date: {{ datas.created_at }}</span>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="py-4">
                        <table class="table table-bordered table-sm caption-top shadow">
                            <caption class="text-center">Preasent Students</caption>

                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Roll_No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Contact</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, index) in datas.attendances" :key="data.id">
                                    <td>{{+ + index }}</td>
                                    <td>
                                        {{ data.students_id }}
                                    </td>
                                    <td>
                                        {{ data.students.name }}
                                    </td>
                                    <td>
                                        <span v-if="data.status == 1">Preasent</span>
                                        <span v-if="data.status == 0">Absent</span>
                                    </td>
                                    <td>{{ data.students.phone_no }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
            datas: [],
            students: []
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/attendance/' + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        }).then((res) => {
            console.log(res)

            this.datas = res.data
            this.students = res.data.attendances
        }).catch((error) => {
            router.push('/admin/login');
            localStorage.clear()
            toast.fire({
                icon: "error",
                title: error.response.data.message
            })
        })



    }
}
</script>

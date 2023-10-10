<template>


    <div class="">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Students Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>RollNo</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Address</th>
                                <th>Phone_no</th>
                                <th>Date_of_birth</th>
                                <th>Email</th>
                                <th>Faculty</th>
                                <th>Section</th>
                                <th>Semester/Years</th>
                                <th>Blood</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Tuitionfee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N</th>
                                <th>RollNo</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Address</th>
                                <th>Phone_no</th>
                                <th>Date_of_birth</th>
                                <th>Email</th>
                                <th>Faculty</th>
                                <th>Section</th>
                                <th>Semester/Years</th>
                                <th>Blood</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>Tuitionfee</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="(student, index) in students" :key="index">
                                <td>{{ ++index }}</td>
                                <td>{{ student . id }}</td>
                                <td>{{ student . name }}</td>
                                <td><img :src="'../' + student.image" alt="" class="img" /></td>
                                <td>{{ student . address }}</td>
                                <td>{{ student . phone_no }}</td>
                                <td>{{ student . DOB }}</td>
                                <td>{{ student . email }}</td>
                                <td>{{ student . faculty . faculty_name }}</td>
                                <td>{{ student . section . section_name }}</td>
                                <td>{{ student . semester . semester_years }}</td>
                                <td>{{ student . blood . blood_group }}</td>
                                <td>{{ student . gender }}</td>
                                <td>{{ student . nationality }}</td>
                                <td>{{ student . tuitionfee }}</td>
                                <td class="float-end">
                                    <button class="btn-success" @click="EditStudent(student.id)">
                                        Edit
                                    </button>
                                    <button class="btn-danger" @click="deleteStudent(student.id)">
                                        delete
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import router from '../../../../adminrouter';
    import store from '../../../../adminstore';

    export default {
        data() {
            return {
                students: [],
                student_edit_data: ""
            };
        },
        created() {
            // if (!User.loggedIn()) {
            //   router.push("/admin/login")
            // }
            axios.get("/api/students", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.state.admintoken,
                },
            }).then((res) => {
                console.log(res);
                this.students = res.data.students;
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
            EditStudent(index) {
                router.push("/admin/students/edit/" + index);
            },
            deleteStudent(index) {
                axios.delete("/api/students/" + index, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + localStorage.getItem("token"),
                    },
                }).then((res) => {
                    this.students = this.students.filter(students => {
                        return students.id != index
                    })
                    router.push("/admin/students");
                    console.log(res);
                });
            },
        },
    };
</script>
<style scoped>
    .img {
        height: 40px;
        width: 40px;
    }
</style>

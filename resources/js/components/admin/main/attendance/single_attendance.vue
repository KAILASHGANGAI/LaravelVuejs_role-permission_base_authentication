<template>
    <div class="card p-2">
        <h1 class="card-title">Students List</h1>
        <div class="d-flex justify-content-around">
            <span>Faculty: {{ detail.faculty.faculty_name }}</span>
            <span>Semester: {{ detail.semester.semester_years }}</span>
            <span>Section: {{ detail.section.section_name }}</span>
            <span>TakenBy: {{ detail.staff_id }}</span>
            <span>Date: {{ detail.created_at }}</span>
        </div>
        <form @submit.prevent="save">
            <div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Roll_No</th>
                            <th>Name</th>
                            <th>Attendance for Present</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in datas" :key="data.id">
                            <td>{{+ + index }}</td>
                            <td>
                                {{ data.id }}
                            </td>

                            <td>{{ data.name }}</td>
                            <td>
                                <!-- <input type="checkbox" v-model="form.attendances"  :value="data.id"> -->
                                <input type="checkbox" v-on:change="changeMyAttendance" :value="data.id">

                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="float-end px-5 mx-4 mb-2 btn-success">Save</button>

            </div>

        </form>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    props: ['id'],
    data() {
        return {
            detail: '',
            datas: [],
            form: {
                createattendances_id: this.id,
                attendances: [],
                absent: []
            }
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/create-attendance/' + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            this.detail = res.data.created
            this.datas = res.data.students
            console.log(this.datas)

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
        changeMyAttendance(checked) {
            if (checked.target.checked === false) {
                this.form.attendances = this.form.attendances.filter(element => element != checked.target.value);
                this.form.absent.push(checked.target.value)
            }
            else {
                this.form.attendances.push(checked.target.value)
                this.form.absent = this.form.absent.filter(element => element != checked.target.value);
            }
            console.log("Attendance")
            console.log(this.form.attendances)
            console.log("Absent")

            console.log(this.form.absent)
        },

        save() {

            axios.post('/api/attendance', this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {

                console.log(res)
                router.push('/admin/attendance-details')
            });
        }
    }
}
</script>

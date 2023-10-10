<template>
    <div class="card p-3">
        <h5 class="card-title">Routing List</h5>
        <div class="d-flex select">
            <div class="form-group">
                <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                <select class="form-control" name="course" id="course" v-model="faculty" required>
                    <option value="null">Choose Faculty</option>
                    <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.id">
                        {{ faculty.faculty_name }}
                    </option>
                </select>
            </div>
            <div class="form-group px-4">
                <label for="">
                    Select Semester / year <samp style="color: red">*</samp>
                </label>
                <br />
                <select class="form-control" name="semester" id="semester" v-model="semester" required>
                    <option value=" ">Select Semester</option>
                    <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                        {{ sem.semester_years }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="id">Section <samp style="color: red">*</samp> :</label><br />
                <select class="form-control" v-model="section">
                    <option value="null ">--section--</option>

                    <option :value="section.id" v-for="section in sections" :key="section.id">
                        {{ section.section_name }}
                    </option>
                </select>

            </div>
            <div class="form-group ">
                <button @click="getrouting" class="btn btn-success mx-2">Get Routing</button>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered table-sm caption-top">
            <caption class="text-center">Exam Routing</caption>
            <thead class="bg-success p-2 text-white">
                <th>S.N</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Time</th>
            </thead>
            <tbody>
                <tr v-for="(exam, index) in exams" :key="index">
                    <td>{{+ + index }}</td>
                    <td>{{ exam.subject }}</td>
                    <td>{{ exam.date }}</td>
                    <td>{{ exam.time }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            facultys: [],
            sems: [],
            sections: [],
            semester: "",
            section: "",
            faculty: "",
            exams: []
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/periods/create", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        }).then((res) => {
            console.log(res);
            this.facultys = res.data.faculty,
                this.sems = res.data.sem,
                this.sections = res.data.section

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
        getrouting() {
            let routing = {
                faculty: this.faculty,
                semester: this.semester,
                section: this.section
            }
            axios.post('/api/routing', routing, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                this.exams = res.data.data
                if (res.data.status == 1) {
                    toast.fire({
                        icon: "success",
                        text: "Routing is available"
                    })
                } else {
                    toast.fire({
                        icon: "error",
                        text: "No Routing is available"
                    })
                }

            })
        }
    }
}
</script>

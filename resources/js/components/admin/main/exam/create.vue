<template>
    <div class="container card">
        <h1 class="card-title">Add Exams</h1>
        <hr>
        <form @submit.prevent="save">
            <div class="d-flex select">
                <div class="form-group">
                    <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                    <select name="course" id="course" v-model="form.faculty_id" required>
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
                    <select name="semester" id="semester" v-model="form.semester_id" required>
                        <option value=" ">Select Semester</option>
                        <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                            {{ sem.semester_years }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id">Section <samp style="color: red">*</samp> :</label><br />
                    <select v-model="form.section_id">
                        <option value="null ">--section--</option>

                        <option :value="section.id" v-for="section in sections" :key="section.id">
                            {{ section.section_name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row py-4">
                <div class="form-group col-sm-4">
                    <label for="">Exam Type</label>
                    <input type="text" class="form-control" v-model="form.exam_type">
                </div>
                <div class="form-group col-sm-4">
                    <label for="">Exam Date</label>
                    <input type="date" class="form-control" v-model="form.date">
                </div>
                <div class="form-grou col-sm-4">
                    <label for="">Exam Time</label>

                    <input type="time" class="form-control" v-model="form.time">

                </div>
                <div class="form-group py-4">
                    <button class="btn btn-success w-100">Save</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
export default {
    data() {

        return {
            facultys: [],
            sems: [],
            sections: [],
            form: {
                semester_id: '',
                section_id: '',
                faculty_id: '',
                exam_type: '',
                date: '',
                time: ''

            }
        }

    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/student/facylty/class/section", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        }).then((res) => {
            console.log(res.data.sem);
            (this.facultys = res.data.faculty),
                (this.sems = res.data.sem),
                (this.sections = res.data.section);
        });
    },
    methods: {
        save() {

            axios.post('/api/exams', this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                console.log(res.status)
                router.push('/admin/exam-show')
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
}
</script>

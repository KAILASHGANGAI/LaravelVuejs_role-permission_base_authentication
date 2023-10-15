<template>
    <div class="container">
        <div class="card ">
            <h1 class="card-title px-2">Take Attendance Of Students</h1>
            <h5 class=" px-2">Date : {{ Date('MM/DD/YYYY') }}</h5>

            <section class="container  p-4">
                <form @submit.prevent="save" class="row">
                    <div class="form-group col-sm-4">
                        <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                        <select class="form-control" name="course" id="course" v-model="form.faculties_id" required>
                            <option value="null">Choose Faculty</option>
                            <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.id">
                                {{ faculty.faculty_name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 px-4">
                        <label for="">
                            Select Semester / year <samp style="color: red">*</samp>
                        </label>
                        <br />
                        <select class="form-control" name="semester" id="semester" v-model="form.semesters_id" required>
                            <option value=" ">Select Semester</option>
                            <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                                {{ sem.semester_years }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="id">Section <samp style="color: red">*</samp> :</label><br />
                        <select class="form-control" v-model="form.section" required>
                            <option value="null ">--section--</option>

                            <option :value="section.id" v-for="section in sections" :key="section.id">
                                {{ section.section_name }}
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Create</button>
                </form>
            </section>
        </div>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            facultys: [],
            sems: [],
            sections: [],
            form: {
                faculties_id: '',
                semesters_id: '',
                section: ''
            }

        };
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/student/facylty/class/section", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            // console.log(res.data.sem);
            (this.facultys = res.data.faculty),
                (this.sems = res.data.sem),
                (this.sections = res.data.section);
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
        save() {
            axios.post("/api/create-attendance", this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                router.push('/admin/attendance-details')
            });

        },
    },
};
</script>

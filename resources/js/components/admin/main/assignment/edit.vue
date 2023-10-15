<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                                    <select class="form-control " name="course" id="course" v-model="faculty" required>
                                        <option value="null">Choose Faculty</option>
                                        <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.id">
                                            {{ faculty.faculty_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6  ">
                                    <label for="">
                                        Select Semester / year <samp style="color: red">*</samp>
                                    </label>
                                    <br />
                                    <select class="form-control " name="semester" id="semester" v-model="semester" required>
                                        <option value=" ">Select Semester</option>
                                        <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                                            {{ sem.semester_years }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="id">Section <samp style="color: red">*</samp> :</label><br />
                                    <select class="form-control" v-model="section">
                                        <option value="null ">--section--</option>

                                        <option :value="section.id" v-for="section in sections" :key="section.id">
                                            {{ section.section_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="subjects">Subjects</label>
                                    <input class="form-control" type="text" v-model="subjects" id="subjects">
                                </div>
                            </div>

                            <div class="row ">


                                <div class="form-group col-sm-6 ">
                                    <label for="topic">Topic</label>
                                    <input class="form-control" type="text" v-model="topic" id="topic">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="deadline">Deadline</label>
                                    <input class="form-control" type="date" v-model="deadline" id="deadline">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="file">Upload File</label>
                                    <input type="file" class="form-control" v-on:change="onChange">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block mt-3">Upload</button>
                        </form>
                    </div>
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
            facultys: [],
            sems: [],
            sections: [],
            name: '',
            file: '',
            faculty: '',
            semester: '',
            section: '',
            subjects: '',
            teacher: '',
            topic: '',
            deadline: '',
            success: ''
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
            console.log(res.data.sem);
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
        }),
        this.getdata()
    },
    props:['id'],
    methods: {
        onChange(e) {
            this.file = e.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    Authorization: "Bearer " + store.getters.getAdminToken,
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('faculty', this.faculty);
            data.append('semester', this.semester);
            data.append('subjects', this.subjects);
            data.append('topic', this.topic);
            data.append('section', this.section);
            data.append('deadline', this.deadline);
            data.append('id', this.id);
            axios.post('/api/assignment/update', data, config)
                .then(function (res) {
                    toast.fire({

                        title: res.data.success
                    })
                    router.push('/admin/show-assignment')
                })
                .catch(function (err) {
                    console.log(err)
                });
        },
        getdata(){
            axios.get("/api/assignment/" + this.id + "/edit", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {

            this.faculty = res.data.faculty_id
            this.semester = res.data.semesters_id
            this.section = res.data.sections_id
            this.subjects = res.data.subject
            this.teacher = res.data.teachers_id
            this.topic = res.data.topic
            this.deadline = res.data.deadline

        });
        }
    }
}
</script>
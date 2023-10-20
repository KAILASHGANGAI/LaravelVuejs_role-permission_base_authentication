<template>
    <div class="container card pb-5">
        <h1 class="card-title">Edit notes</h1>
        <form @submit="save" enctype="multipart/form-data">
            <div class="d-flex select">
                <div class="form-group">
                    <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                    <select name="course" id="course" v-model="faculty" required>
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
                    <select name="semester" id="semester" v-model="semester" required>
                        <option value=" ">Select Semester</option>
                        <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                            {{ sem.semester_years }}
                        </option>
                    </select>
                </div>
            </div>
            <hr />
            <div class="row ">
                <div class="form-group col-sm-6">
                    <label for="subjects">Subjects</label>
                    <input class="form-control" type="text" v-model="subjects" id="subjects">
                </div>
                
                <div class="form-group col-sm-6">
                    <label for="topic">Topic</label>
                    <input class="form-control" type="text" v-model="topic" id="topic">
                </div>
                <div class="form-group col-sm-6">
                    <label for="file">File</label>
                    <input type="file" class="form-control" v-on:change="onChange">
                </div>
                <button type="submit" class="btn btn-success mt-3">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
import router from '../../../adminrouter'
import store from '../../../adminstore';

export default {

    data() {

        return {
            facultys: [],
            sems: [],
            
                semester: '',
                faculty: '',
                subjects: '',
                file: '',
                topic: '',
                deadline: ''
            
        }

    },
    props: ['id'],
    methods: {
        onChange(e) {
            this.file = e.target.files[0];
        },
        save(e) {
            e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    Authorization: "Bearer " +store.getters.getAdminToken,
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('faculty', this.faculty);
            data.append('semester', this.semester);
            data.append('subjects', this.subjects);
            data.append('topic', this.topic);
            data.append('id', this.id);
            axios.post('/api/teacher/notes/update', data, config)
                .then(function (res) {
                    toast.fire({
                      title: res.data.success
                  })
                    router.push('/teacher/show-notes')
                })
                .catch(function (err) {
                   console.log(err)
                });
        }
    },

    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/teacher/facylty/class/section", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
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
        })
        axios.get("/api/teacher/notes/" + this.id + "/edit", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
            this.faculty = res.data.faculty_id
            this.semester = res.data.semesters_id

            this.subjects = res.data.subject
            this.teacher = res.data.teachers_id
            this.topic = res.data.topic


        });
    },

}
</script>

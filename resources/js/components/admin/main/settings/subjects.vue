<template>
    <h1> Subjects</h1>

    <div class="d-flex select">
        <div class="form-group">
            <label for="id">Course <samp style="color: red">*</samp> :</label><br />
            <select name="course" id="course" @change="SelectSubject" required>
                <option value="null">Choose Faculty</option>
                <option v-for="facultyItem in facultys" :key="facultyItem.id" :value="facultyItem.id">
                    {{ facultyItem.faculty_name }}
                </option>
            </select>
        </div>
        <div class="form-group px-4">
            <label for="">
                Select Semester / year <samp style="color: red">*</samp>
            </label>
            <br />
            <select name="semester" id="semester" @change="filterSubject" required>
                <option value=" ">Select Semester</option>
                <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                    {{ sem.semester_years }}
                </option>
            </select>
        </div>
        <router-link to="/admin/add-subjects" class="btn btn-success p-0"> Add Subject</router-link>

    </div>
    <hr>

    <div class="container">
        <table class="table border">
            <tr>
                <th>S.N</th>
                <th>Faculty</th>
                <th>Semester</th>
                <th>Subject</th>
                <th>Subjects_code</th>
                <th>Full Marks</th>
                <th>Pass Marks</th>
                <th>Practical Full Marks</th>
                <th>Practical Pass Marks</th>
                <th>Creadit Hrs</th>
                <th>Action</th>
            </tr>
            <tr v-for="(data, index) in datas" :key="index">
                <td>{{ ++index }}</td>
                <td>{{ data.faculty.faculty_name }}</td>
                <td>{{ data.semester.semester_years }}</td>
                <td>{{ data.subjects }}</td>
                <td>{{ data.subjects_code }}</td>
                <td>{{ data.fullmarks }}</td>
                <td>{{ data.passmarks }}</td>
                <td>{{ data.practical_fullmarks }}</td>
                <td>{{ data.practical_passmarks }}</td>
                <td>{{ data.creadit_hrs }}</td>
                <td><span class="btn btn-danger text-danger" @click="deleteSubject(data.id)">Delete</span></td>

            </tr>
            <button v-for="page in totalPages" :key="page" @click="goToPage(page)">
                {{ page }}
            </button>
        </table>

    </div>
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            counts: 0,
            facultys: [],
            sems: [],
            datas: [],
            form: {
                faculty: '',
                semester: ''
            },
            currentPage: 1,
            totalPages: 1,
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        // get api data
        axios.get("/api/periods/create", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res);
            this.facultys = res.data.faculty;
            this.sems = res.data.sem;

        }).catch((error) => {
            router.push('/admin/login');
            localStorage.clear()

            toast.fire({
                icon: "error",
                title: error.response.data.message
            })
        })
        this.getSubjects()
    },
    methods: {
        getSubjects() {
            axios.get("/api/subjects", {
                params: {
                    page: this.currentPage,
                },
            }, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
                this.datas = res.data.data;
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page


            });
        },
        goToPage(page) {
            this.currentPage = page;
            this.getSubjects();
        },
        SelectSubject(e) {
            var item = e.target.value
            axios.get('/api/subjects/faculty=/' + item, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                this.datas = res.data
            })

        },
        filterSubject(e) {
            var item = e.target.value
            this.datas = this.datas.filter(datas => {
                return datas.semester_id == item
            })
        },
        deleteSubject(index) {
            axios.get('/api/subjects/delete/' + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
            })
        }

    }
}
</script>
<style>
table,
tr,
th,
td {
    border: 1px solid black;
    text-align: center;
}
</style>
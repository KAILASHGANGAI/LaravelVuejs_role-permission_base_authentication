<template>
    <div class="">
        <h5>Class Sheduling</h5>

        <div class="d-flex select">
            <div class="form-group">
                <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                <select name="course" id="course" v-model="form.faculty" required>
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
                <select name="semester" v-model="form.semester" required>
                    <option value=" ">Select Semester</option>
                    <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                        {{ sem.semester_years }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="id">Section <samp style="color: red">*</samp> :</label><br />
                <select v-model="form.section">
                    <option value=" ">--section--</option>

                    <option :value="section.id" v-for="section in sections" :key="section.id">
                        {{ section.section_name }}
                    </option>
                </select>
            </div>
            <div>
                <button class="float-right mx-5 px-5 my-3 btn-success" type="submit" @click="Generate()">
                    Generate
                </button>
            </div>
        </div>
        <hr />
        <div class="container-fluid">
            <div class="row">
                <div v-for="(item, index) in datas" :key="index" class="col-4">
                    <div class="card p-2">
                        <div class="text-center py-2">
                            <span class="school-name fs-5 fw-bold">Amity International School</span> <br>
                            <spam class="address fs-6 fw-bold">Biratnagar-8, Madhumara</spam> <br>
                            <span class=" fs-6 fw-bold">School IdCard</span>
                        </div>

                        <div class="mx-auto">
                            <img :src="'../' + item.image" alt="" class="avatar">
                        </div>
                        <h2 class="text-center py-1 fs-5 ">{{ item.name }}</h2>

                        <div class="p-1  fw-bold ">
                            <span>Faculty:{{ item.faculty.faculty_name }} </span> <br />
                            <span>Address: {{ item.address }} </span><br />
                            <span>Contact:{{ item.address }} </span><br />
                        </div>
                        <hr>
                        <div class="fs-6 fw-bold text-center ">
                            <span>Contact No: 021-25478</span> <br>
                            <span>w.w.w.schoolwebsite.com</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from "axios";
import router from '../../../../adminrouter';
export default {
    data() {
        return {
            facultys: [],
            sems: [],
            sections: [],
            form: {
                faculty: "",
                semester: "",
                section: "",
            },
            datas: [],
        };
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
        Generate() {
            axios
                .post("/api/getstudents-details", this.form, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + localStorage.getItem("token"),
                    },
                })
                .then((res) => {
                    this.datas = res.data;
                    console.log(res);
                })
                .catch((error = {}));
        },
    },
};
</script>
<style scoped>
.avatar {
    width: 120px;
    height: 120px;
    border: 4px solid black;
    border-radius: 50%;
    margin: auto;
}

.details span {
    font-size: 15px;

}
</style>

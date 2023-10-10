<template>
    <h1>add Subjects</h1>
    <form method="post" @submit.prevent="save()">
        <div class="d-flex select">
            <div class="form-group">
                <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                <select name="course" id="course" v-model="form.faculty" required>
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
                <select name="semester" id="semester" v-model="form.semester" required>
                    <option value=" ">Select Semester</option>
                    <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                        {{ sem.semester_years }}
                    </option>
                </select>
            </div>
        </div>
        <hr>
        <span class="mx-3 btn btn-success " @click="count()">
            +
        </span>
        <span class="mx-3 btn btn-danger " @click="decrease()">
            -
        </span>
        <input type="submit" class="mx-3 btn btn-success" value="save">

        <div class="container">
            <table class="table border">
                <tr>
                    <th>S.N</th>
                    <th>Subject</th>
                    <th>Subjects_code</th>
                    <th>Full Marks</th>
                    <th>Pass Marks</th>
                    <th>Practical Full Marks</th>
                    <th>Practical Pass Marks</th>
                    <th>Creadit Hrs</th>
                </tr>
                <tr v-for="index in counts" :key="index">
                    <td>{{ index }} </td>
                    <td><input type="text" class="w-100" v-model="form.subjects[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.subjects_code[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.fullMarks[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.passMarks[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.p_fullMarks[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.p_passMarks[index]" id="" /></td>
                    <td><input type="text" class="w-100" v-model="form.creadit_hrs[index]" id="" /></td>
                </tr>
            </table>
        </div>

    </form>
</template>
<script>
import router from '../../../../adminrouter';

export default {

    data() {
        return {
            counts: 0,
            facultys: [],
            sems: [],
            form: {
                subjects: [],
                subjects_code: [],
                fullMarks: [],
                passMarks: [],
                p_fullMarks: [],
                p_passMarks: [],
                creadit_hrs: [],
                semester: '',
                faculty: '',
            }

        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get("/api/periods/create", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
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
    },
    methods: {
        count() {
            this.counts++;
        },
        decrease() {
            if (this.counts > 1) {
                this.counts--;

            }
        },
        save() {
            axios.post('/api/subjects', this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                toast.fire({
                    icon: "succcess",
                    title: res.data.status
                });
                router.push("/admin/subjects")

            })

        }
    }
}
</script>
<template>
    <div class="container card">
        <h1 class="card-title">Take Book </h1>

        <div class="d-flex select">
            <div class="form-group">
                <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                <select name="course" id="course" v-model="faculty" required>
                    <option value="null">Choose Faculty</option>
                    <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.id">{{ faculty.faculty_name }}
                    </option>

                </select>
            </div>
            <div class="form-group px-4">
                <label for="">
                    Select Semester / year <samp style="color: red">*</samp>
                </label>
                <br />
                <select name="semester" v-model="semester" @change="getBooks()" required>
                    <option value=" ">Select Semester</option>
                    <option :value="sem.id" v-for="sem in sems" :key="sem.id">{{ sem.semester_years }}</option>
                </select>
            </div>

            <div>
                <button class="float-right mx-5 px-5 my-3 btn-success" type="submit" @click="save()">
                    save
                </button>
            </div>
        </div>
        <hr>
    </div>
    <div class="container card">
        <div class="row">
            <div class="col-md-8">
                <h2 class="card-titl">Books Lists</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>S.n</th>
                        <th>Book</th>
                        <th>Publication</th>
                        <th>Quantity</th>
                        <th>Avilable</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <tr v-for="(book, index) in books" :key="index">
                            <td>{{+ + index }}</td>
                            <td>{{ book.book_name }}</td>
                            <td>{{ book.publication }}</td>
                            <td>{{ book.total }}</td>
                            <td> <span v-if="book.total">availabel</span>  <span v-else>not availabel</span></td>
                            <td>
                                <input type="checkbox" v-model="booktaken" :value="book.id">
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-md-4">
                <h3 class="card-">Student Details</h3>
                <input type="text" @input="getstudent()" v-model="getstudents" placeholder="Enter student Name">
                <div>
                    <span>
                        Roll No: {{ data.id }} <br>
                        Name:{{ data.name }} ,<br>
                        Address:{{ data.address }}, <br>
                        Contact no: {{ data.phone_no }}, <br>
                        Faculty:{{ data.faculty }}, <br>
                        Section: {{ data.section_id }}, <br>
                        Semester/years:{{ data.semester_yrs }}, <br>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from '../../../../adminstore';
export default {
    data() {
        return {
            facultys: [],
            sems: [],
            sections: [],

            faculty: '',
            semester: '',
            books: [],

            data: '',
            booktaken: []
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
                Authorization: "Bearer " +store.getters.getAdminToken,
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
        getstudent() {
            let std = {
                'student': this.getstudents
            }
            axios.post('/api/show-student-detail', std, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
                this.data = res.data
            });
        },
        getBooks() {
            let book = {
                "faculty": this.faculty,
                "semester": this.semester
            }
            axios.post('/api/show-books-list', book, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                this.books = res.data
            });

        },
        save() {
            let taken = {
                "books": this.booktaken.toString(),
                'student': this.data.id

            }
            axios.post('/api/save-books-taken', taken, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
                if (res.data.status == 1) {
                    toast.fire({
                        icon: "success",
                        text: "book taken SUCCESSFULLY"
                    })
                } else {
                    toast.fire({
                        icon: "error",
                        text: "ALREADY  TAKEN"
                    })
                }
            });
        }
    }
}
</script>

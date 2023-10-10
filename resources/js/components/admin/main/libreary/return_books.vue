<template>
    <h1>return book </h1>
    <input type="text" @input="getstudent()" v-model="getstudents" placeholder="Enter student Name">

    <div class="contain">
        <span>
            Roll No: {{ student.id }} <br>
            Name:{{ student.name }} ,<br>
            Address:{{ student.address }}, <br>
            Contact no: {{ student.phone_no }}, <br>
            Faculty:{{ student.faculty }}, <br>
            Section: {{ student.section_id }}, <br>
            Semester/years:{{ student.semester_yrs }}, <br>
        </span>
        <button class="btn btn-success m-1 float-end" @click="UpdateMe()"> Return </button>

        <table class="table table-bordered">

            <thead>
                <th>S.n</th>
                <th>Book</th>
                <th>Status</th>
                <th>Date</th>
                <th>Acton</th>
            </thead>
            <tbody>

                <tr v-for="(book, index) in student.libreary" :key="index">
                    <td>{{+ + index }}</td>
                    <td>{{ book.books.book_name }}</td>
                    <td>{{ book.status }}</td>
                    <td>{{ book.created_at }}</td>

                    <td>
                        <input v-if="book.status == 0" type="checkbox" v-model="booktaken" :value="book.id">
                        <span v-if="book.status == 1">Returned</span>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            student: '',
            books: [],
            booktaken: []
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
    },
    methods: {
        getstudent() {
            let std = {
                'student': this.getstudents
            }
            axios.post('/api/show-books-taken', std, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                console.log(res)
                this.student = res.data.student

            });
        },

        UpdateMe() {
            let std = {
                'books': this.booktaken.toString()
            }
            axios.post('/api/return-books-taken', std, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                    this.getstudent();
                toast.fire({
                    icon: "success",
                    text: res.data
                })
                router.push("/admin/return-books");
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

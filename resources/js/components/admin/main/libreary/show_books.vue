<template>
    <div class="container-fluid card p-2">
        <h1 class="card-title">Libreary Details</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="bg-success text-white">
                    <tr>
                        <th>S.N</th>
                        <th>Book_Name</th>
                        <th>Publication</th>
                        <th>Faculty</th>
                        <th>Semester/Year</th>
                        <th>Total</th>
                        <th>Taken</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <td>{{+ + index }}</td>
                        <td>{{ data.book_name }}</td>
                        <td>{{ data.publication }}</td>
                        <td>{{ data.faculty.faculty_name }}</td>
                        <td>{{ data.semester.semester_years }}</td>
                        <td>{{ data.total }}</td>
                        <td>{{ data.status }}</td>
                        <td>

                            <button class=" btn text-success" @click="EditBook(data.id)">
                                <i class="ri-edit-box-fill"></i>
                            </button>
                            <button class="btn text-danger" @click="deleteBook(data.id)">
                                <i class="ri-delete-bin-2-fill"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
export default {
    data() {
        return {
            datas: []
        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get("/api/libreary", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        }).then((res) => {
            this.datas = res.data
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
        EditBook(index) {
            router.push('/admin/libreary/edit/' + index);
        },
        deleteBook(index) {
            axios.delete("/api/libreary/" + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                this.datas = this.datas.filter(datas => {
                    return this.datas.id != index
                })
                router.push("/admin/show-books")
                console.log(res)
            });
        }
    }
}
</script>

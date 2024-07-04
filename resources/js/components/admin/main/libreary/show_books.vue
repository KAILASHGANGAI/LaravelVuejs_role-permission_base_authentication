<template>
    <div class="container-fluid card p-2">
        <h6 class="m-0 font-weight-bold text-primary p-3">Libreary Details</h6>
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

                            <button class=" btn btn-success" @click="EditBook(data.id)">
                               Edit
                            </button>
                            <button class="btn btn-danger" @click="deleteBook(data.id)">
                                Delete
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
import store from '../../../../adminstore';

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
                Authorization: "Bearer " + store.getters.getAdminToken,
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
                    Authorization: "Bearer " + store.getters.getAdminToken,
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

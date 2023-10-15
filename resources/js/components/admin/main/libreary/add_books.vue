<template>
    <section class="container ">

        <div class="">
            <div class="row student">
                <div class="form col-sm-8 mx-auto card">
                    <h1 class="card-title">add book</h1>
                    <hr>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Book Name.</label> <br />
                            <input type="text" class="form-control" v-model="name" id="" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Book Publication.</label> <br />
                            <input type="text" class="form-control" v-model="publication" id="" required />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="id">Course <samp style="color: red">*</samp> :</label><br />
                            <select name="course" class="form-control" id="course" v-model="faculty">
                                <option value="null" class="default">Choose Faculty</option>
                                <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.id">
                                    {{ faculty.faculty_name }}</option>

                            </select>
                        </div>
                        <div class="form-group col-sm-6 px-4">
                            <label for="">
                                Select Semester / year <samp style="color: red">*</samp>
                            </label>
                            <br />
                            <select class="form-control" name="semester" v-model="semester" required>
                                <option value=" ">Select Semester</option>
                                <option :value="sem.id" v-for="sem in sems" :key="sem.id">{{ sem.semester_years }}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Total No of Books.</label> <br />
                            <input class="form-control" type="number" v-model="total" id="total" />
                        </div>

                        <div class="float-right py-3">
                            <button @click="save()" class="px-3">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
            publication: '',
            faculty: '',
            semester: '',
            total: '',


        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/libreary/create", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            // console.log(res);
            this.facultys = res.data.faculty,
                this.sems = res.data.sem,
                this.sections = res.data.section

        });
    },
    methods: {
        save() {
            let libreary = {
                "name": this.name,
                'publication': this.publication,
                'faculty': this.faculty,
                'semester': this.semester,
                'total': this.total
            }
            axios.post('/api/libreary', libreary, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                router.push('/admin/show-books')
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

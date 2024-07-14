<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1>View Note</h1>

                <div>
                    <span>Subject: {{ datas.subject }}</span> <br>
                    <span>faculty_id: {{ datas.faculty.faculty_name }}</span> <br>
                    <span>Semester: {{ datas.semester.semester_years }}</span> <br>
                    <span>students_id: {{ datas.students_id }}</span><br>
                    <span>topic: {{ datas.topic }}</span> <br>
                    <span>deadline: {{ datas.deadline }}</span><br>
                    <span>Date: {{ datas.created_at.split('T')[0] }}</span>

                </div>
                <button class="btn btn-primary" @click="download">Download</button>
            </div>
            <div class="col-sm-8">
                <embed :src="datas.file_path + '#toolbar=0&navpanes=0&scrollbar=0'" type="" class="w-100"
                    style="height: 90vh;">

            </div>
        </div>


    </div>
</template>

<script>
import router from '../../../adminrouter'
import store from '../../../adminstore';

export default {

    data() {

        return {
            datas: '',

        }

    },
    props: ['id'],
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/student/get-facylty/class/section", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res.data.sem);
            (this.facultys = res.data.faculty),
                (this.sems = res.data.sem),
                (this.sections = res.data.section);
        });
        axios.get("/api/student/notes/" + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            this.datas = res.data;
            console.log(res)


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
        download() {

            window.location.href = '/api/download/notes/' + this.id;
        },

    }

}
</script>
<style scoped>
#toolbar {
    display: none !important;
}
</style>
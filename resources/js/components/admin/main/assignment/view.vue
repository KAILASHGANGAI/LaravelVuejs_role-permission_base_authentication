<template>
    <h1>View assignment</h1>
    <div class="container">
        <div>
            <span>Subject: {{ datas.subject }}</span> <br>
            <span>faculty_id: {{ datas.faculty_id }}</span> <br>
            <span>sections_id: {{ datas.sections_id }}</span><br>
            <span>teachers_id: {{ datas.teachers_id }}</span><br>
            <span>topic: {{ datas.topic }}</span> <br>
            <span>deadline: {{ datas.deadline }}</span><br>
            <span>Date: {{ datas.created_at.split('T')[0] }}</span>

        </div>
        <button class="btn btn-primary" @click="download">Download</button>

    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

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
        axios.get("/api/student/facylty/class/section", {
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
        axios.get("/api/assignment/" + this.id, {
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
            axios.get('/api/download/assignment/' + this.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                const pdfData = res.data
                const blob = new Blob([pdfData], { type: 'application/pdf' })
                const url = URL.createObjectURL(blob)

                const a = document.createElement('a')
                a.href = url
                a.download = 'example.pdf'
                a.click()

                URL.revokeObjectURL(url)

                toast.fire({
                    icon: "success",
                    title: res.data.message
                })
            })
        }
    }

}
</script>

<template>
    <div class="card p-2">
        <h5 class="card-title">Single Periods</h5>

        <div class="container">
            <h6>
                Faculty : {{ datas.faculty_id }}
            </h6>
            <h6>
                Faculty : {{ datas.semesters_id }}
            </h6>
            <h6>
                Faculty :{{ datas.section_id }}
            </h6>
            <h6>Number Of Periods :{{ datas.no_of_periods }}</h6>
        </div>
        <table class="table-bordered ">
            <tr>
                <th>Subjects</th>
                <td v-for="(item, index) in datas.subjects.split(',')" :key="index">{{ item }}</td>
            </tr>
            <tr>
                <th>Teacher</th>
                <td v-for="(item, index) in datas.teachers.split(',')" :key="index">{{ item }}</td>

            </tr>
            <tr>
                <th>Time</th>
                <td v-for="(item, index) in datas.starttimes.split(',')" :key="index">
                    {{ item }}-{{ datas.endtimes.split(',')[index] }}</td>

            </tr>
        </table>
    </div>
</template>

<script>
import store from '../../../../adminstore';

export default {
    data() {
        return {
            datas: [],
        };
    },
    props: ["id"],
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/periods/" + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res.data.subjects);
            this.datas = res.data;

        }).catch((error) => {
            router.push('/admin/login');
        localStorage.clear()
            toast.fire({
                icon: "error",
                title: error.response.data.message
            })
        })
    },
};
</script>

<template>
    <div class="card p-2">
        <h5 class="card-title">Leave Lists</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Leave Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in datas" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ data.leave_type }}</td>
                    <td>{{ data.start_date }}</td>
                    <td>{{ data.end_date }}</td>
                    <td>{{ data.reason }}</td>
                    <td>{{ data.status }}</td>
                    <td>
                        <button v-if="data.status == 'Pending'" class="btn btn-success" @click="Edit(data.id)">
                            Edit
                        </button>

                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
import router from '../../../adminrouter';
import store from '../../../adminstore';

export default {
    data() {
        return {
            datas: [],
        };
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        axios.get("/api/student/leave", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res.data);
            this.datas = res.data;
        });
    },
    methods: {
        Edit(id) {
            router.push("/student/leave/" + id + "/edit/");
        },
    },
};
</script>

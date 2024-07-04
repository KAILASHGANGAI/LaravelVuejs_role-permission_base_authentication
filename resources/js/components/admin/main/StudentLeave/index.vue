<template>
    <div class="card p-2">
        <h5 class="card-title">Leave Lists</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Leave Type</th>
                    <th>Days</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Reason</th>
                    <th>RejectReason</th>

                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in datas" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ data.leave_type }}</td>
                    <td>{{ data.leave_days }}</td>
                    <td>{{ data.start_date }}</td>
                    <td>{{ data.end_date }}</td>
                    <td>{{ data.reason }}</td>
                    <td>{{ data.decline_reason }}</td>
                    <td>{{ data.status }}</td>
                    <td>
                        <button v-if="data.status != 'Approved'" class="btn btn-success" @click="approve(data.id)">
                            Approve
                        </button>
                        <button v-if="data.status !== 'Rejected'" class="btn btn-warning" @click="reject(data.id)">
                            Reject
                        </button>
                        <button class="btn btn-danger" @click="Leavedelete(data.id)">
                            Delete
                        </button>


                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="modal" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Reason</h5>
                        <button type="button" class="close" @click="showModal = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="onSubmit">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rejectReason">Reason for rejection:</label>
                                <textarea id="rejectReason" class="form-control" v-model="rejectReason"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-else class="modal" style="display: none;"></div>
    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            datas: [],
            showModal: false,
            rejectReason: '',
            rejectID: null
        };
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        //get api data
        this.getdata()
    },
    methods: {
        approve(index) {
            axios.get("/api/student-leave-approve/" + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.getdata()
                toast.fire({
                    icon: "succcess",
                    title: res.data.message
                })
            });
        },
        reject(index) {
            this.rejectID = index,
            this.showModal = true

        },
        onSubmit() {
            let data = {
                rejectReason : this.rejectReason,
                rejectID :this.rejectID
            };
            axios.post("/api/student-leave-reject/" + this.rejectID, data, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.rejectID =''
                this.rejectReason =''
                this.showModal = false

                this.getdata()
                console.log(res)
                toast.fire({
                    icon: "succcess",
                    title: res.data.message
                })
            });
        },
        Leavedelete(index) {
            axios.delete("/api/student-leave/" + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.getdata()

                toast.fire({
                    icon: "succcess",
                    title: res.data.message
                })
            });
        },
        getdata() {
            axios.get("/api/student-leave", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res.data);

                this.datas = res.data;
            });
        }

    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* semi-transparent black */
    z-index: 9999;
    /* ensure modal is on top of everything */
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-dialog {
    background-color: #fff;
    border-radius: 5px;
    max-width: 500px;
    width: 100%;
}

.modal-content {
    padding: 20px;
}
</style>
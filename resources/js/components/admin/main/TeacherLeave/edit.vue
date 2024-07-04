<template>
    <div class="card p-2">
        <h5 class="card-title">Leave Update</h5>
        <div class="form">
            <form @submit.prevent="save">
                <div class="form-group">
                    <label for="name">Leave Type:</label>
                    <select v-model="form.leave_type" class="form-control">
                        <option value="sick">Sick</option>
                        <option value="vacation">Vacation</option>
                        <option value="personal">Personal</option>
                        <option value="other">Other</option>
                    </select>
                    <small v-if="errors.leave_type" class="text-danger">{{ errors.leave_type[0] }}</small>

                </div>
                <div class="form-group">
                    <label for="date">Start:</label>
                    <input class="form-control" type="date" v-model="form.start_date">
                    <small v-if="errors.start_date" class="text-danger">{{ errors.start_date[0] }}</small>

                </div>

                <div class="form-group">
                    <label for="status">End:</label>
                    <input class="form-control" type="date" v-model="form.end_date">
                    <small v-if="errors.end_date" class="text-danger">{{ errors.end_date[0] }}</small>

                </div>
                <div class="form-group">
                    <label for="reason">Reason:</label>
                    <textarea class="form-control" type="text" v-model="form.reason"></textarea>
                    <small v-if="errors.reason" class="text-danger">{{ errors.reason[0] }}</small>

                </div>
                <button class="btn btn-primary" type="submit">Submit</button>

            </form>
        </div>

    </div>
</template>

<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';
export default {
    data() {
        return {
            form: {
                leave_type: '',
                start_date: '',
                end_date: '',
                reason: ''
            },
            errors: {}

        }

    },
    props: ['id'],
    created() {

        axios.get("/api/teacher/leave/" + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },

        }).then((res) => {
            console.log(res.data);
            this.form = res.data
        }).catch((error) => {
            console.log(error)
        })

    },
    methods: {
        save() {
            axios.put("/api/teacher/leave/" + this.id, this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                }

            }).then((res) => {
                console.log(res);
                toast.fire({
                    icon: "succcess",
                    title: res.data.message
                })
                router.push('/teacher/leave')

            }).catch((error) => {
                this.errors = error.response.data.errors
                console.log(error)
                toast.fire({
                    icon: "succcess",
                    title: error.data.message
                })
            })

        }
    }

}

</script>

<template>
    <div class="container pt-4">
        <div class="row">
            <div class="col-sm-6 mx-auto shadow p-4">
                <span v-if="error" class=" text-danger">
                    {{ error }}
                </span>
                <form method="post" @submit.prevent="login">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword1">

                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import router from '../../router'
import { useStore } from 'vuex'
import store from '../../store'

export default {
    setup() {
        const store = useStore()
    },
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            error: ''
        }
    },
    methods: {
        async login() {
            await axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', this.form).then((res) => {
                    console.log(res)
                    if (res.data.status == 1) {
                        store.dispatch('setUser', res.data.username)
                        store.dispatch('setToken', res.data.token)
                        window.location = '/admin'
                    } else {

                        this.error = res.data.status
                    }
                })
            });
        }
    }
}
</script>
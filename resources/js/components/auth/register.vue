<template>
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4 mx-auto shadow p-4">
            <div class="">
                <div class="card-body">
                    <form method="POST" @submit.prevent="register">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " v-model="form.name" required
                                    autocomplete="name" autofocus>
                                    <span v-if="errors.name" class=" text-danger">
                                    {{ errors.name[0] }}
                                </span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " v-model="form.email" required
                                    autocomplete="email">
                                    <span v-if="errors.email" class=" text-danger">
                                    {{ errors.email[0] }}
                                </span>
                            </div>
                        </div>
                      
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " v-model="form.password" required
                                    autocomplete="new-password">
                                <span v-if="errors.password" class=" text-danger">
                                    {{ errors.password[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Conform
                                Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    v-model="form.password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submmit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import router from '../../router'

export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {}
        }
    },
    methods: {
        async register() {
            await axios.post('/api/register', this.form).then((res) => {
                //console.log(res.data.status)
                if(res.data.status == 1){
                    router.push('/login')
                }
            }).catch((errors) => {
                this.errors = errors.response.data.errors
            })
        }
    }
}

</script>
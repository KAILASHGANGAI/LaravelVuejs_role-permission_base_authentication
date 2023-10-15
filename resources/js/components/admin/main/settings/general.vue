<template>
    <h1>General</h1>
    <hr />
    <div class="container">
        <form @submit.prevent="UpdateSave()" method="post">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">school_name</label>
                        <input type="text" class="form-control" v-model="form.school_name" id="" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">phone</label>
                        <input type="text" class="form-control" v-model="form.phone" id="" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">email</label>
                        <input type="email" class="form-control" v-model="form.email" id="" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">address</label>
                        <input type="text" class="form-control" v-model="form.address" id="" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">pan_number</label>
                        <input type="text" class="form-control" v-model="form.pan_number" id="" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">logo</label>
                        <input type="file" name="logo" id="logo" @change="changeImg" />
                        <img :src="img" alt="" srcset="" height="100" />
                    </div>
                </div>
                <input type="submit" value="Save" class="btn btn-success mt-4" />
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            form: {
                school_name: null,
                phone: null,
                email: null,
                address: null,
                pan_number: null,
                logo: null,
            },
            data: "",
        };
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/general-details', {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " +store.getters.getAdminToken,
            },
        }).then((res) => {
            this.form = res.data
            this.img = res.data.logo
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
        changeImg(event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = (event) => {
                this.img = event.target.result;
                this.form.logo = event.target.result;
            };
            reader.readAsDataURL(file);
            console.log(event);
        },
        UpdateSave() {
            axios.put('/api/general-details/' + this.form.id, this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
            })
        },
    },
};
</script>

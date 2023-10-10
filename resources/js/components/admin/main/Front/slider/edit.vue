<template>
    <div class="container card pb-5">
        <h1 class="card-title"> Edit Slider</h1>
        <div class="container">
            <form @submit.prevent="save()" method="post">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Heading</label>
                            <input type="text" v-model="form.heading" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Sub Heading</label>
                            <input type="text" v-model="form.subheading" class="form-control">
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" v-model="form.description" class="form-control">
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" id="image" @change="changeImg" />
                            <img :src="form.image" alt="" srcset="" height="100" />
                            <img v-if="id" :src="'../../' + image" alt="" srcset="" height="100" />
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary my-4" value="Save">

                </div>
            </form>
        </div>
    </div>
</template>
    
<script>
import axios from 'axios';
import router from '../../../../../adminrouter';

export default {
    data() {
        return {
            form: {
                heading: null,
                subheading: null,
                description: null,
                image: null
            },
            image: null

        }
    },
    props: ['id'],
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/edit-slider/' + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        }).then((res) => {
            this.form = res.data
            this.image = res.data.image
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
                this.form.image = event.target.result;
            };
            reader.readAsDataURL(file);
            console.log(file);
        },
        save() {
            axios.patch('/api/slider/' + this.id, this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                router.push('/admin/slider')
                toast.fire({
                    icon: "succcess",
                    title: res.data.status
                })
            })
        }
    }
}
</script>
    
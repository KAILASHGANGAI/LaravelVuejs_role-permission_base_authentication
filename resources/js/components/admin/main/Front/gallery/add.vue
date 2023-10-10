<template>
    <form @submit.prevent="save()" method="post">
        <div class="">
            <label for="image"> Images :</label> <br />
            <input type="file" name="image" id="" @change="EducationImg" multiple />

            <div class="row">
                <div class="col-md-3" v-for="(eduImage, index) in form.eduImages" :key="index">
                    <img :src="eduImage" alt="" srcset="" class="img-fluid" />

                </div>
            </div>

        </div>
        <input type="submit" value="save" class="btn btn-success">
    </form>
</template>
<script>
import router from '../../../../../adminrouter';

export default {
    data() {
        return {

            form: {
                eduImages: [],

            }

        }
    },
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
    },
    methods: {

        EducationImg(e) {
            this.form.eduImages = [];
            let fileList = Array.prototype.slice.call(e.target.files);

            fileList.forEach(f => {
                if (f.type.includes('image')) {
                    let reader = new FileReader();
                    let that = this;

                    reader.onload = function (e) {
                        that.form.eduImages.push(e.target.result);
                    };
                    reader.readAsDataURL(f);
                }
            });
        },
        save() {
            axios.post('/api/gallery', this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem("token"),
                },
            }).then((res) => {
                router.push('/gallery')
                toast.fire({
                    icon: "succcess",
                    title: res.data.status
                })
            }).catch((error) => {
                router.push('/admin/login');
                localStorage.clear()
                toast.fire({
                    icon: "error",
                    title: error.response.data.message
                })
            })
        }






    }
}

</script>
<style scoped>
.main {
    display: flex;
    flex-grow: 1;
    align-items: center;
    height: 100vh;
    justify-content: center;
    text-align: center;
}

.dropzone-container {
    padding: 4rem;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
}

.hidden-input {
    opacity: 0;
    overflow: hidden;
    position: absolute;
    width: 1px;
    height: 1px;
}

.file-label {
    font-size: 20px;
    display: block;
    cursor: pointer;
}

.preview-container {
    display: flex;
    margin-top: 2rem;
}

.preview-card {
    display: flex;
    border: 1px solid #a2a2a2;
    padding: 5px;
    margin-left: 5px;
}

.preview-img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
    border: 1px solid #a2a2a2;
    background-color: #a2a2a2;
}
</style>
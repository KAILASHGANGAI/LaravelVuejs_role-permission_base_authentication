<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add guardian/Parents Details</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3">
              <div class="col-md-12">
                <input type="text" class="form-control" id="inputName5" placeholder="Name" v-model="name" />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail5" placeholder="Email" v-model="email" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="inputEmail5" placeholder="Phone Number" v-model="phone" />
              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="inputAddres5s" placeholder="Address" v-model="address" />
              </div>
              <div class="col-md-6">
                <label for="image"> Image :</label> <br />
                <div class="d-flex">
                  <input class="form-control" ref="fileInput" type="file" @input="pickFile" />
                  <img v-if="previewImage" :src="previewImage" alt="" class="" height="100" />
                </div>
              </div>
              <div class="text-center">
                <button type="reset" class="btn btn-secondary mx-3 float-end" @click="save()">
                  Save
                </button>
                <router-link type="submit" class="btn btn-primary float-end" to="/add_student">
                  Previous
                </router-link>
              </div>
            </form>
            <!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      address: "",
      photo: "",
      previewImage: "",
    };
  },
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
  },

  methods: {
    //image upload and preview methods
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
    save() {
      let Parents = {
        name: this.name,
        email: this.email,
        phone: this.phone,
        address: this.address,
        photo: this.previewImage,
      };
      axios.post("http://127.0.0.1:8000/api/guardian", Parents, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " +store.getters.getAdminToken,
        },
      }).then((Response) => {
        router.push("/admin/students");
        // toast.fire({
        //     icon:"succcess",
        //     title:"record added successfully"
        // })
        //console.log(Response);
      }).catch((error) => {
        router.push('/admin/login');
        localStorage.clear()
        toast.fire({
          icon: "error",
          title: error.response.data.message
        })
      })
    },
  },
};
</script>